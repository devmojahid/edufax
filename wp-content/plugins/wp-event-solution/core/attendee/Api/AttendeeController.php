<?php
/**
 * Attendee Api Class
 *
 * @package Eventin\Attendee
 */
namespace Eventin\Attendee\Api;

use Etn\Core\Attendee\Attendee_Exporter;
use Etn\Core\Attendee\Attendee_Importer;
use Etn\Core\Attendee\Attendee_Model;
use Etn\Core\Event\Event_Model;
use WP_Error;
use WP_Query;
use WP_REST_Controller;
use WP_REST_Server;

/**
 * Attendee Controller Class
 */
class AttendeeController extends WP_REST_Controller {
    /**
     * Constructor for AttendeeController
     *
     * @return void
     */
    public function __construct() {
        $this->namespace = 'eventin/v2';
        $this->rest_base = 'attendees';
    }

    /**
     * Check if a given request has access to get items.
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_Error|boolean
     */
    public function register_routes() {
        register_rest_route( $this->namespace, $this->rest_base, [
            [
                'methods'             => WP_REST_Server::READABLE,
                'callback'            => [$this, 'get_items'],
                'permission_callback' => [$this, 'get_item_permissions_check'],
            ],
            [
                'methods'             => WP_REST_Server::CREATABLE,
                'callback'            => [$this, 'create_item'],
                'permission_callback' => [$this, 'create_item_permissions_check'],
            ],
            [
                'methods'             => WP_REST_Server::DELETABLE,
                'callback'            => [$this, 'delete_items'],
                'permission_callback' => [$this, 'delete_item_permissions_check'],
            ],
        ] );

        register_rest_route(
            $this->namespace,
            '/' . $this->rest_base . '/(?P<id>[\d]+)',
            array(
                'args'   => array(
                    'id' => array(
                        'description' => __( 'Unique identifier for the post.', 'eventin' ),
                        'type'        => 'integer',
                    ),
                ),
                array(
                    'methods'             => WP_REST_Server::READABLE,
                    'callback'            => array( $this, 'get_item' ),
                    'permission_callback' => array( $this, 'get_item_permissions_check' ),
                    'args'                => $this->get_collection_params(),
                ),
                array(
                    'methods'             => WP_REST_Server::EDITABLE,
                    'callback'            => array( $this, 'update_item' ),
                    'permission_callback' => array( $this, 'update_item_permissions_check' ),
                    'args'                => $this->get_endpoint_args_for_item_schema( WP_REST_Server::EDITABLE ),
                ),
                [
                    'methods'             => WP_REST_Server::DELETABLE,
                    'callback'            => [$this, 'delete_item'],
                    'permission_callback' => [$this, 'delete_item_permissions_check'],
                ],
                // 'allow_batch' => $this->allow_batch,
                'schema' => array( $this, 'get_item_schema' ),
            ),
        );

        register_rest_route( $this->namespace, $this->rest_base . '/export', [
            [
                'methods'             => WP_REST_Server::READABLE,
                'callback'            => [$this, 'export_items'],
                'permission_callback' => [$this, 'export_item_permissions_check'],
            ],
        ] );

        register_rest_route( $this->namespace, $this->rest_base . '/import', [
            [
                'methods'             => WP_REST_Server::CREATABLE,
                'callback'            => [$this, 'import_items'],
                'permission_callback' => [$this, 'import_item_permissions_check'],
            ],
        ] );
    }

    /**
     * Get a collection of items.
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_Error|WP_REST_Response
     */
    public function get_items( $request ) {

        $per_page = ! empty( $request['per_page'] ) ? intval( $request['per_page'] ) : 20;
        $paged    = ! empty( $request['paged'] ) ? intval( $request['paged'] ) : 1;
        $type     = ! empty( $request['type'] ) ? sanitize_text_field( $request['type'] ) : '';
        $event_id     = ! empty( $request['event_id'] ) ? sanitize_text_field( $request['event_id'] ) : '';
        $payment_status = ! empty( $request['payment_status'] ) ? sanitize_text_field( $request['payment_status'] ) : '';
        $ticket_status     = ! empty( $request['ticket_status'] ) ? sanitize_text_field( $request['ticket_status'] ) : '';

        $search   = ! empty( $request['search'] ) ? sanitize_text_field( $request['search'] ) : '';

        $args = [
            'post_type'      => 'etn-attendee',
            'post_status'    => 'any',
            'posts_per_page' => $per_page,
            'paged'          => $paged,
        ];

        $meta_query = [];

        if ( ! empty( $event_id ) ) {
            $meta_query[] = [
                'key'     => 'etn_event_id',
                'value'   => $event_id,
                'compare' => '=',
            ];
        }

        if ( ! empty( $payment_status ) ) {
            $meta_query[] = [
                'key'     => 'etn_status',
                'value'   => $payment_status,
                'compare' => '=',
            ];
        }

        if ( ! empty( $ticket_status ) ) {
            $meta_query[] = [
                'key'     => 'etn_attendeee_ticket_status',
                'value'   => $ticket_status,
                'compare' => '=',
            ];
        }

        if ( ! empty( $meta_query ) ) {
            $meta_query['relation'] = 'AND';

            $args['meta_query'] = $meta_query; 
        }

        if ( $search ) {
            // $args['s'] = $search;

            $meta_query = array(
                'relation' => 'OR', // 'OR' means any meta key can match
                array(
                    'key'     => 'etn_name',
                    'value'   => $search,
                    'compare' => 'LIKE'
                ),
                array(
                    'key'     => 'etn_email',
                    'value'   => $search,
                    'compare' => 'LIKE'
                ),
                array(
                    'key'     => 'etn_phone',
                    'value'   => $search,
                    'compare' => 'LIKE'
                ),
                array(
                    'key'     => 'ticket_name',
                    'value'   => $search,
                    'compare' => 'LIKE'
                ),
                array(
                    'key'     => 'etn_event_id',
                    'value'   => $search,
                    'compare' => 'LIKE'
                ),
                array(
                    'key'     => 'etn_status',
                    'value'   => $search,
                    'compare' => 'LIKE'
                ),
                array(
                    'key'     => 'order_id',
                    'value'   => $search,
                    'compare' => 'LIKE'
                ),
                array(
                    'key'     => 'etn_attendeee_ticket_status',
                    'value'   => $search,
                    'compare' => '='
                ),
            );

            $args['meta_query'] = $meta_query; 
        }

        $attendees = [];

        $post_query   = new WP_Query();
        $query_result = $post_query->query( $args );
        $total_posts  = $post_query->found_posts;

        foreach ( $query_result as $post ) {
            $attendee  = new Attendee_Model( $post->ID );
            $post_data = $this->prepare_item_for_response( $attendee, $request );

            $attendees[] = $this->prepare_response_for_collection( $post_data );
        }

        $response = rest_ensure_response( $attendees );

        $response->header( 'X-WP-Total', $total_posts );

        return $response;
    }

    /**
     * Get one item from the collection.
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_Error|WP_REST_Response
     */
    public function get_item( $request ) {
        $id       = intval( $request['id'] );
        $attendee = new Attendee_Model( $id );

        $item = $this->prepare_item_for_response( $attendee, $request );

        $response = rest_ensure_response( $item );

        return $response;
    }

    /**
     * Check if a given request has access to get items.
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_Error|boolean
     */
    public function get_item_permissions_check( $request ) {
        return current_user_can( 'manage_options' );
    }

    /**
     * Creates a single event.
     *
     * @since 4.0.0
     *
     * @param WP_REST_Request $request Full details about the request.
     * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
     */
    public function create_item( $request ) {
        $prepared_item = $this->prepare_item_for_database( $request );

        if ( is_wp_error( $prepared_item ) ) {
            return $prepared_item;
        }

        $prepared_item['etn_info_edit_token'] = md5('etn-attendee-info');

        $attendee = new Attendee_Model();
        $attendee->set_fields( $prepared_item );
        $created  = $attendee->create( $prepared_item );

        $event  = new Event_Model( $prepared_item['etn_event_id'] );

        if ( $event->is_expaired() ) {
            return new WP_Error(
                'event_expired',
                __( 'Please select another event. This event is already expired.', 'eventin' ),
                array( 'status' => 400 )
            );
        }

        if ( ! $created ) {
            return new WP_Error(
                'attendee_create_error',
                __( 'Attendee can not be created.', 'eventin' ),
                array( 'status' => 500 )
            );
        }

        $item = $this->prepare_item_for_response( $attendee, $request );

        do_action( 'eventin_attendee_created', $attendee, $request );

        $response = rest_ensure_response( $item );
        $response->set_status( 201 );

        return $response;
    }

    /**
     * Checks if a given request has access to create a event.
     *
     * @since 4.0.0
     *
     * @param WP_REST_Request $request Full details about the request.
     * @return true|WP_Error True if the request has access to create items, WP_Error object otherwise.
     */
    public function create_item_permissions_check( $request ) {
        return current_user_can( 'manage_options' );
    }

    /**
     * Updates a single event.
     *
     * @since 4.0.0
     *
     * @param WP_REST_Request $request Full details about the request.
     * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
     */
    public function update_item( $request ) {
        $prepared_item = $this->prepare_item_for_database( $request );

        if ( is_wp_error( $prepared_item ) ) {
            return $prepared_item;
        }

        $attendee = new Attendee_Model( $request['id'] );
        $attendee->set_fields( $prepared_item );
        $updated  = $attendee->update( $prepared_item );

        if ( ! $updated ) {
            return new WP_Error(
                'attendee_update_error',
                __( 'Attendee can not be updated.', 'eventin' ),
                array( 'status' => 500 )
            );
        }

        $item = $this->prepare_item_for_response( $attendee, $request );

        do_action( 'eventin_attendee_updated', $attendee, $request );

        $response = rest_ensure_response( $item );

        return $response;
    }

    /**
     * Checks if a given request has access to update a event.
     *
     * @since 4.0.0
     *
     * @param WP_REST_Request $request Full details about the request.
     * @return true|WP_Error True if the request has access to update the item, WP_Error object otherwise.
     */
    public function update_item_permissions_check( $request ) {
        return current_user_can( 'manage_options' );
    }

    /**
     * Delete one item from the collection.
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_Error|WP_REST_Response
     */
    public function delete_item( $request ) {
        $id = intval( $request['id'] );

        $attendee = new Attendee_Model( $id );
        $previous = $this->prepare_item_for_response( $attendee, $request );
        $deleted  = $attendee->delete();
        $response = new \WP_REST_Response();

        $response->set_data(
            array(
                'deleted'  => true,
                'previous' => $previous,
            )
        );

        if ( ! $deleted ) {
            return new WP_Error(
                'rest_cannot_delete',
                __( 'The attendee cannot be deleted.', 'eventin' ),
                array( 'status' => 500 )
            );
        }

        do_action( 'eventin_attendee_deleted', $id );

        return $response;
    }

    /**
     * Delete multiple items from the collection.
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_Error|WP_REST_Response
     */
    public function delete_items( $request ) {
        $ids = ! empty( $request['ids'] ) ? $request['ids'] : [];

        if ( ! $ids ) {
            return new WP_Error(
                'rest_cannot_delete',
                __( 'Attendee ids can not be empty.', 'eventin' ),
                array( 'status' => 400 )
            );
        }
        $count = 0;

        foreach ( $ids as $id ) {
            $attendee = new Attendee_Model( $id );

            if ( $attendee->delete() ) {
                $count++;
            }
        }

        if ( $count == 0 ) {
            return new WP_Error(
                'rest_cannot_delete',
                __( 'Attendee cannot be deleted.', 'eventin' ),
                array( 'status' => 500 )
            );
        }

        $message = sprintf( __( '%d Attendee are deleted of %d', 'eventin' ), $count, count( $ids ) );

        return rest_ensure_response( $message );
    }

    /**
     * Prepare the item for create or update operation.
     *
     * @param WP_REST_Request $request Request object.
     * @return WP_Error|object $prepared_item
     */
    public function delete_item_permissions_check( $request ) {
        return current_user_can( 'manage_options' );
    }

    /**
     * Prepare the item for the REST response.
     *
     * @param mixed           $item WordPress representation of the item.
     * @param WP_REST_Request $request Request object.
     * @return WP_REST_Response $response
     */
    public function prepare_item_for_response( $item, $request ) {
        $data =  $item->get_data();
        $data['extra_fields'] = $item->get_extra_fields();

        return $data;
    }

    /**
     * Prepare the item for create or update operation.
     *
     * @param WP_REST_Request $request Request object.
     * @return WP_Error|object $prepared_item
     */
    protected function prepare_item_for_database( $request ) {
        $prepared_item = [];
        $input_data    = json_decode( $request->get_body(), true );

        if ( ! empty( $input_data['etn_name'] ) ) {
            $prepared_item['etn_name'] = $input_data['etn_name'];
        }

        if ( ! empty( $input_data['etn_email'] ) ) {
            $prepared_item['etn_email'] = $input_data['etn_email'];
        }

        if ( ! empty( $input_data['etn_phone'] ) ) {
            $prepared_item['etn_phone'] = $input_data['etn_phone'];
        }

        if ( ! empty( $input_data['etn_event_id'] ) ) {
            $prepared_item['etn_event_id'] = $input_data['etn_event_id'];
        }

        if ( ! empty( $input_data['ticket_id'] ) ) {
            $prepared_item['etn_unique_ticket_id'] = $input_data['ticket_id'];
        }

        if ( ! empty( $input_data['ticket_name'] ) ) {
            $prepared_item['ticket_name'] = $input_data['ticket_name'];
        }

        if ( ! empty( $input_data['ticket_slug'] ) ) {
            $prepared_item['ticket_slug'] = $input_data['ticket_slug'];
        }

        if ( ! empty( $input_data['etn_attendeee_ticket_status'] ) ) {
            $prepared_item['etn_attendeee_ticket_status'] = $input_data['etn_attendeee_ticket_status'];
        }

        if ( ! empty( $input_data['etn_ticket_price'] ) ) {
            $prepared_item['etn_ticket_price'] = $input_data['etn_ticket_price'];
        }

        if ( ! empty( $input_data['etn_status'] ) ) {
            $prepared_item['etn_status'] = $input_data['etn_status'];
        }

        if ( ! empty( $input_data['extra_fields'] ) ) {
            $extra_fields = $this->prepare_attendee_extra_fields( $input_data['extra_fields'] );

            if ( $extra_fields && is_array( $extra_fields ) ) {
                $prepared_item = array_merge( $prepared_item, $extra_fields );
            }
        }

        $prepared_item['post_status'] = 'publish';

        $prepared_item['etn_unique_ticket_id'] = time();

        
        
        return $prepared_item;
    }

    /**
     * Prepare attendee extra fields
     *
     * @param   array  $extra_fields Attendee extra fields
     *
     * @return  array Prepare extra fields data for database
     */
    protected function prepare_attendee_extra_fields( $extra_fields ) {
        $prefix = 'etn_attendee_extra_field_';

        $data = [];

        // Add extra fields meta key prefix.
        foreach( $extra_fields as $key => $value ) {
            $meta_key = $prefix . $key;

            $data[$meta_key] = $value;
        }

        return $data;
    }

    /**
     * Attendee exporter
     *
     * @param   WP_Request  $request
     *
     * @return  json
     */
    public function export_items( $request ) {
        $format = ! empty( $request['format'] ) ? sanitize_text_field( $request['format'] ) : '';

        $ids    = ! empty( $request['ids'] ) ? $request['ids'] : '';

        if ( ! $format ) {
            return new WP_Error( 'format_error', __( 'Invalid data format', 'eventin' ) );
        }

        if ( ! $ids ) {
            return new WP_Error( 'data_error', __( 'Invalid ids', 'eventin' ), ['status' => 409] );
        }

        $exporter = new Attendee_Exporter();

        $exporter->export( $ids, $format );
    }

    /**
     * Check export items permissions
     *
     * @param   WP_Rest_Request  $request  [$request description]
     *
     * @return  bool
     */
    public function export_item_permissions_check( $request ) {
        return current_user_can( 'manage_options' );
    }

    /**
     * Attendee exporter
     *
     * @param   WP_Request  $request
     *
     * @return  json
     */
    public function import_items( $request ) {
        $data = $request->get_file_params();
        $file = ! empty( $data['attendee_import'] ) ? $data['attendee_import'] : '';

        if ( ! $file ) {
            return new WP_Error( 'empty_file', __( 'You must provide a valid file.', 'eventin' ), ['status' => 409] );
        }

        $importer = new Attendee_Importer();
        $importer->import( $file );

        $response = [
            'message' => __( 'Successfully imported attendee', 'eventin' ),
        ];

        return rest_ensure_response( $response );
    }

    /**
     * Check permissions for import attendees
     *
     * @param   WP_Rest_Request  $request  [$request description]
     *
     * @return  bool
     */
    public function import_item_permissions_check( $request ) {
        return current_user_can( 'manage_options' );
    }
}