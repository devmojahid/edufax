import App from "./App";
import { render } from '@wordpress/element';



// Render the App component into the DOM

window.addEventListener(
    'load',
    function(){
        render(<App />, document.getElementById('tp-admin-app'));
    },
    false
)