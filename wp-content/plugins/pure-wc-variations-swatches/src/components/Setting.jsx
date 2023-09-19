import React from "react";
import Switch from "react-switch";
import { toast } from "react-toastify";
// internal
import refresh from "../assets/img/icon/refresh.png";
import { ColorPicker, Button, ColorIndicator, Modal } from '@wordpress/components';
import { notifyError } from "../utils/toast";

const Setting = () => {

  const [settingActive, setSettingActive] = React.useState("general");
  const [loading, setLoading] = React.useState(false);
  const [tooltip, setTooltip] = React.useState(tpwvs_admin_settings.tpwvs_general.tooltip);
  const [tooltipBackgroundColor, setTooltipBackgroundColor] = React.useState(tpwvs_admin_settings.tpwvs_general.tooltip_background);
  const [tooltipBackgroundModal, setTooltipBackgroundModal] = React.useState(false);
  const [tooltipFontColor, setTooltipFontColor] = React.useState(tpwvs_admin_settings.tpwvs_general.tooltip_font_color);
  const [tooltipFontModal, setTooltipFontModal] = React.useState(false);
  const [tooltipPosition, setTooltipPosition] = React.useState(tpwvs_admin_settings.tpwvs_general.tooltip_position);
  const [swatchStyle, setSwatchStyle] = React.useState(tpwvs_admin_settings.tpwvs_general.swatch_style);
  const [swatchSize, setSwatchSize] = React.useState(tpwvs_admin_settings.tpwvs_general.swatch_size);
  const [swatch, setSwatch] = React.useState(tpwvs_admin_settings.tpwvs_shop.enable_swatches);
  const [swatchPosition, setSwatchPosition] = React.useState(tpwvs_admin_settings.tpwvs_shop.swatch_position);
  const [swatchLabel, setSwatchLabel] = React.useState(tpwvs_admin_settings.tpwvs_shop.swatch_label);
  const [swatchAlignments, setSwatchAlignMents] = React.useState(tpwvs_admin_settings.tpwvs_shop.swatch_alignments);

  // handle active tab
  const handleActiveTab = (value) => {
    setSettingActive(value);
  };


  /**
   * 
   * @genneral_settings 
   */

  // handle toggle change
  const handleTooltipToggle = async (isChecked) => {
    setTooltip(tooltip => !tooltip);

    const formData = new FormData();
    formData.append('action', 'tpwvs_update_settings');
    formData.append('security', tpwvs_admin_settings.update_nonce);
    formData.append('tpwvs_general', JSON.stringify({ tooltip: isChecked, tooltip_position: tooltipPosition, tooltip_background: tooltipBackgroundColor, tooltip_font_color: tooltipFontColor, swatch_style: swatchStyle, swatch_size: swatchSize }));

    // fetch data
    const resolveWithSomeData = await fetch(tpwvs_admin_settings.api_url, {
      method: 'POST', // *GET, POST, PUT, DELETE, etc.
      body: formData // body data type must match "Content-Type" header
    });


    // manage loading state
    toast.promise(resolveWithSomeData.json(), {
      pending: {
        render() {
          setLoading(true)
          return "Data is loading";
        },
        icon: true,
      },
      success: {
        render({ data }) {
          setLoading(false)
          return `${data.data.message}`;
        },
        icon: true,
      },
      error: {
        render({ data }) {
          return notifyError("Api loaded failed")
        },
      },
    });
  };


  // handle tooltip position
  const handleTooltipPosition = async (e) => {
    setTooltipPosition(e.target.value);
    const formData = new FormData();
    formData.append('action', 'tpwvs_update_settings');
    formData.append('security', tpwvs_admin_settings.update_nonce);
    formData.append('tpwvs_general', JSON.stringify({ tooltip: tooltip, tooltip_position: e.target.value, tooltip_background: tooltipBackgroundColor, tooltip_font_color: tooltipFontColor, swatch_style: swatchStyle, swatch_size: swatchSize }));

    // fetch data
    const resolveWithSomeData = await fetch(tpwvs_admin_settings.api_url, {
      method: 'POST', // *GET, POST, PUT, DELETE, etc.
      body: formData // body data type must match "Content-Type" header
    });


    // manage loading state
    toast.promise(resolveWithSomeData.json(), {
      pending: {
        render() {
          setLoading(true)
          return "Data is loading";
        },
        icon: true,
      },
      success: {
        render({ data }) {
          setLoading(false)
          return `${data.data.message}`;
        },
        icon: true,
      },
      error: {
        render({ data }) {
          return notifyError("Api loaded failed")
        },
      },
    });
  }

  // handle style 
  const handleStyle = async (e) => {
    setSwatchStyle(e.target.value);
    const formData = new FormData();
    formData.append('action', 'tpwvs_update_settings');
    formData.append('security', tpwvs_admin_settings.update_nonce);
    formData.append('tpwvs_general', JSON.stringify({ tooltip: tooltip, tooltip_position: tooltipPosition, tooltip_background: tooltipBackgroundColor, tooltip_font_color: tooltipFontColor, swatch_style: e.target.value, swatch_size: swatchSize }));

    // fetch data
    const resolveWithSomeData = await fetch(tpwvs_admin_settings.api_url, {
      method: 'POST', // *GET, POST, PUT, DELETE, etc.
      body: formData // body data type must match "Content-Type" header
    });


    // manage loading state
    toast.promise(resolveWithSomeData.json(), {
      pending: {
        render() {
          setLoading(true)
          return "Data is loading";
        },
        icon: true,
      },
      success: {
        render({ data }) {
          setLoading(false)
          return `${data.data.message}`;
        },
        icon: true,
      },
      error: {
        render({ data }) {
          return notifyError("Api loaded failed")
        },
      },
    });
  }

  // save tooltip backround color
  const handleTooltipBackground = async () => {
    setTooltipBackgroundModal(false);
    const formData = new FormData();
    formData.append('action', 'tpwvs_update_settings');
    formData.append('security', tpwvs_admin_settings.update_nonce);
    formData.append('tpwvs_general', JSON.stringify({ tooltip: tooltip, tooltip_position: tooltipPosition, tooltip_background: tooltipBackgroundColor, tooltip_font_color: tooltipFontColor, swatch_style: swatchStyle, swatch_size: swatchSize }));

    // fetch data
    const resolveWithSomeData = await fetch(tpwvs_admin_settings.api_url, {
      method: 'POST', // *GET, POST, PUT, DELETE, etc.
      body: formData // body data type must match "Content-Type" header
    });


    // manage loading state
    toast.promise(resolveWithSomeData.json(), {
      pending: {
        render() {
          setLoading(true)
          return "Data is loading";
        },
        icon: true,
      },
      success: {
        render({ data }) {
          setLoading(false)
          return `${data.data.message}`;
        },
        icon: true,
      },
      error: {
        render({ data }) {
          return notifyError("Api loaded failed")
        },
      },
    });
  }

  const closeBackgroundModal = () => setTooltipBackgroundModal(false);


  // save tooltip font color
  const handleTooltipFontColor = async () => {
    setTooltipFontModal(false);
    const formData = new FormData();
    formData.append('action', 'tpwvs_update_settings');
    formData.append('security', tpwvs_admin_settings.update_nonce);
    formData.append('tpwvs_general', JSON.stringify({ tooltip: tooltip, tooltip_position: tooltipPosition, tooltip_background: tooltipBackgroundColor, tooltip_font_color: tooltipFontColor, swatch_style: swatchStyle, swatch_size: swatchSize }));

    // fetch data
    const resolveWithSomeData = await fetch(tpwvs_admin_settings.api_url, {
      method: 'POST', // *GET, POST, PUT, DELETE, etc.
      body: formData // body data type must match "Content-Type" header
    });


    // manage loading state
    toast.promise(resolveWithSomeData.json(), {
      pending: {
        render() {
          setLoading(true)
          return "Data is loading";
        },
        icon: true,
      },
      success: {
        render({ data }) {
          setLoading(false)
          return `${data.data.message}`;
        },
        icon: true,
      },
      error: {
        render({ data }) {
          return notifyError("Api loaded failed")
        },
      },
    });
  }

  const closeFontModal = () => setTooltipFontModal(false);


  // save swatch size
  const handleSwatchSize = async () => {
    const formData = new FormData();
    formData.append('action', 'tpwvs_update_settings');
    formData.append('security', tpwvs_admin_settings.update_nonce);
    formData.append('tpwvs_general', JSON.stringify({ tooltip: tooltip, tooltip_position: tooltipPosition, tooltip_background: tooltipBackgroundColor, tooltip_font_color: tooltipFontColor, swatch_style: swatchStyle, swatch_size: swatchSize }));

    // fetch data
    const resolveWithSomeData = await fetch(tpwvs_admin_settings.api_url, {
      method: 'POST', // *GET, POST, PUT, DELETE, etc.
      body: formData // body data type must match "Content-Type" header
    });


    // manage loading state
    toast.promise(resolveWithSomeData.json(), {
      pending: {
        render() {
          setLoading(true)
          return "Data is loading";
        },
        icon: true,
      },
      success: {
        render({ data }) {
          setLoading(false)
          return `${data.data.message}`;
        },
        icon: true,
      },
      error: {
        render({ data }) {
          return notifyError("Api loaded failed")
        },
      },
    });
  }


  /**
   * 
   * @archive_settings 
   */
  // handle toggle change
  const handleSwatchesToggle = async (isChecked) => {
    setSwatch(swatch => !swatch);

    const formData = new FormData();
    formData.append('action', 'tpwvs_update_settings');
    formData.append('security', tpwvs_admin_settings.update_nonce);
    formData.append('tpwvs_shop', JSON.stringify({ enable_swatches: isChecked, swatch_position: swatchPosition, swatch_alignments: swatchAlignments, swatch_label: swatchLabel }));

    // fetch data
    const resolveWithSomeData = await fetch(tpwvs_admin_settings.api_url, {
      method: 'POST', // *GET, POST, PUT, DELETE, etc.
      body: formData // body data type must match "Content-Type" header
    });


    // manage loading state
    toast.promise(resolveWithSomeData.json(), {
      pending: {
        render() {
          setLoading(true)
          return "Data is loading";
        },
        icon: true,
      },
      success: {
        render({ data }) {
          setLoading(false)
          return `${data.data.message}`;
        },
        icon: true,
      },
      error: {
        render({ data }) {
          return notifyError("Api loaded failed")
        },
      },
    });
  };

  // handle swatch label change
  const handleSwatcheLabel = async (isChecked) => {
    setSwatchLabel(swatchLabel => !swatchLabel);

    const formData = new FormData();
    formData.append('action', 'tpwvs_update_settings');
    formData.append('security', tpwvs_admin_settings.update_nonce);
    formData.append('tpwvs_shop', JSON.stringify({ enable_swatches: swatch, swatch_position: swatchPosition, swatch_alignments: swatchAlignments, swatch_label: isChecked }));

    // fetch data
    const resolveWithSomeData = await fetch(tpwvs_admin_settings.api_url, {
      method: 'POST', // *GET, POST, PUT, DELETE, etc.
      body: formData // body data type must match "Content-Type" header
    });


    // manage loading state
    toast.promise(resolveWithSomeData.json(), {
      pending: {
        render() {
          setLoading(true)
          return "Data is loading";
        },
        icon: true,
      },
      success: {
        render({ data }) {
          setLoading(false)
          return `${data.data.message}`;
        },
        icon: true,
      },
      error: {
        render({ data }) {
          return notifyError("Api loaded failed")
        },
      },
    });
  };

  // handle position
  const handleSwatchPosition = async (e) => {
    setSwatchPosition(e.target.value);
    const formData = new FormData();
    formData.append('action', 'tpwvs_update_settings');
    formData.append('security', tpwvs_admin_settings.update_nonce);
    formData.append('tpwvs_shop', JSON.stringify({ enable_swatches: swatch, swatch_position: e.target.value, swatch_alignments: swatchAlignments, swatch_label: swatchLabel }));

    // fetch data
    const resolveWithSomeData = await fetch(tpwvs_admin_settings.api_url, {
      method: 'POST', // *GET, POST, PUT, DELETE, etc.
      body: formData // body data type must match "Content-Type" header
    });


    // manage loading state
    toast.promise(resolveWithSomeData.json(), {
      pending: {
        render() {
          setLoading(true)
          return "Data is loading";
        },
        icon: true,
      },
      success: {
        render({ data }) {
          setLoading(false)
          return `${data.data.message}`;
        },
        icon: true,
      },
      error: {
        render({ data }) {
          return notifyError("Api loaded failed")
        },
      },
    });
  }

  // handle alignments
  const handleSwatchAlignments = async (e) => {
    setSwatchAlignMents(e.target.value);
    const formData = new FormData();
    formData.append('action', 'tpwvs_update_settings');
    formData.append('security', tpwvs_admin_settings.update_nonce);
    formData.append('tpwvs_shop', JSON.stringify({ enable_swatches: swatch, swatch_position: swatchPosition, swatch_alignments: e.target.value, swatch_label: swatchLabel }));

    // fetch data
    const resolveWithSomeData = await fetch(tpwvs_admin_settings.api_url, {
      method: 'POST', // *GET, POST, PUT, DELETE, etc.
      body: formData // body data type must match "Content-Type" header
    });


    // manage loading state
    toast.promise(resolveWithSomeData.json(), {
      pending: {
        render() {
          setLoading(true)
          return "Data is loading";
        },
        icon: true,
      },
      success: {
        render({ data }) {
          setLoading(false)
          return `${data.data.message}`;
        },
        icon: true,
      },
      error: {
        render({ data }) {
          return notifyError("Api loaded failed")
        },
      },
    });
  }

  return (
    <div className="tpv-settings-page bg-gray rounded-3xl px-[1rem] sm:px-[1.5rem] md:px-[2.725rem] lg:px-[50px] xl:px-[80px] pb-[62px] py-11">
      <div className="grid grid-cols-1">
        <div className="tpv-dashboard-header flex justify-between items-center mb-[37px]">
          <h3 className="text-5xl font-medium mb-0">Settings</h3>

          <div className="tpv-dashboard-refresh">
            <button type="button">
              <img src={refresh} alt="refresh" className={loading ? 'rotate-animation' : ''} />
            </button>
          </div>
        </div>
        <div className="tp-settings-tab" x-data="{tab: 1}">
          <div className="tpv-settings-tab-nav flex flex-wrap items-center">
            <button
              onClick={() => handleActiveTab("general")}
              type="button"
              className={`text-2xl font-medium px-8 py-6 hover:text-theme relative after:absolute after:content-[''] after:bottom-0 after:h-[2px] after:bg-theme after:rounded-br-md after:rounded-bl-md after:shadow-2xl after:transition after:duration-300 after:ease-in-out
                    ${settingActive === "general"
                  ? "text-theme after:left-0 after:right-auto after:w-full"
                  : "text-text3 after:left-auto after:right-0 after:w-0"
                }`}
            >
              General
            </button>
            <button
              onClick={() => handleActiveTab("shop-archive")}
              type="button"
              className={`text-2xl font-medium px-8 py-6 hover:text-theme relative after:absolute after:content-[''] after:bottom-0 after:h-[2px] after:bg-theme after:rounded-br-md after:rounded-bl-md after:shadow-2xl after:transition after:duration-300 after:ease-in-out ${settingActive === "shop-archive"
                  ? "text-theme after:left-0 after:right-auto after:w-full"
                  : "text-text3 after:left-auto after:right-0 after:w-0"
                }`}
            >
              Shop/Archive
            </button>
          </div>
          <div className="tpv-settings-tab-content bg-white rounded-xl rounded-tl-none">
            {settingActive === "general" && (
              <div className="tpv-settings-general">
                {/* <!-- item 2 --> */}
                <div className="tpv-settings-option sm:flex justify-between items-center pt-[26px] pb-[23px] px-9 border-[#F4F5F9] border-b-2 last:border-0">
                  <div className="tpv-settings-option-content mb-4 sm:mb-0">
                    <h4 className="text-lg mb-0">
                      Enable Tooltip
                    </h4>
                    <p className="mb-0">
                      Enable tooltip on the swatches for showing label.
                    </p>
                  </div>
                  {/* <!-- switch --> */}
                  <div className="tpv-settings-option-switch">
                    <div className="flex sm:justify-center items-center">
                      <label>
                        <Switch
                          onChange={handleTooltipToggle}
                          checked={tooltip}
                          className={`react-switch ${tooltip?'active':''}`}
                          uncheckedIcon={false}
                          checkedIcon={false}
                          id="material-switch"
                        />
                      </label>
                    </div>
                  </div>
                </div>

                {/* <!-- item 3 --> */}
                <div className="tpv-settings-option sm:flex justify-between items-center pt-[26px] pb-[23px] px-9 border-[#F4F5F9] border-b-2 last:border-0">
                  <div className="tpv-settings-option-content mb-4 sm:mb-0">
                    <h4 className="text-lg mb-0">Tooltip Position</h4>
                    <p className="mb-0">
                      Turn the default type to button type.
                    </p>
                  </div>
                  {/* <!-- select option --> */}
                  <div className="tpv-settings-option-select tp-tooltip-select">
                    <select onChange={handleTooltipPosition} className={tooltipPosition} value={tooltipPosition}>
                      <option value={"top"}>Top</option>
                      <option value={"bottom"}>Bottom</option>
                      <option value={"left"}>Left</option>
                      <option value={"right"}>Right</option>
                    </select>
                  </div>
                </div>

                {/* <!-- toolltip background color  --> */}
                <div className="tpv-settings-option sm:flex justify-between items-center pt-[26px] pb-[23px] px-9 border-[#F4F5F9] border-b-2 last:border-0">
                  <div className="tpv-settings-option-content mb-4 sm:mb-0">
                    <h4 className="text-lg mb-0">Tooltip Background</h4>
                    <p className="mb-3">
                      Change the toolltip background color by selecting a dynamic color.
                    </p>
                    <Button
                      isSmall={true}
                      onClick={handleTooltipBackground}
                      variant="primary">Save</Button>
                  </div>
                  {/* <!-- select option --> */}
                  <div className="tpv-settings-option-select tp-tooltip-select tp-toolltip-color">
                    <div className="tp-color-indicator" onClick={() => setTooltipBackgroundModal(true)} onBlur={closeBackgroundModal}>
                      <div className="tp-indicator">
                        <ColorIndicator
                          colorValue={tooltipBackgroundColor}
                        />
                      </div>
                      <p>{tooltipBackgroundColor}</p>
                      {tooltipBackgroundModal && <div className="tp-color-picker"
                        onBlur={closeBackgroundModal}>
                        <ColorPicker
                          color={tooltipBackgroundColor}
                          onChange={setTooltipBackgroundColor}
                          defaultValue={tooltipBackgroundColor}
                        />

                      </div>}
                    </div>
                  </div>
                </div>


                {/* <!-- toolltip font color  --> */}
                <div className="tpv-settings-option sm:flex justify-between items-center pt-[26px] pb-[23px] px-9 border-[#F4F5F9] border-b-2 last:border-0">
                  <div className="tpv-settings-option-content mb-4 sm:mb-0">
                    <h4 className="text-lg mb-0">Tooltip Font Color</h4>
                    <p className="mb-3">
                      Change the toolltip font color by selecting a dynamic color.
                    </p>
                    <Button
                      isSmall={true}
                      onClick={handleTooltipFontColor}
                      variant="primary">Save</Button>
                  </div>
                  {/* <!-- select option --> */}
                  <div className="tpv-settings-option-select tp-tooltip-select tp-toolltip-color">


                    <div className="tp-color-indicator" onClick={() => setTooltipFontModal(true)} onBlur={closeFontModal}>
                      <div className="tp-indicator">
                        <ColorIndicator
                          colorValue={tooltipFontColor}
                        />
                      </div>
                      <p>{tooltipFontColor}</p>
                      {tooltipFontModal && <div className="tp-color-picker" onBlur={closeFontModal}>
                        <ColorPicker
                          color={tooltipFontColor}
                          onChange={setTooltipFontColor}
                          defaultValue={tooltipFontColor}
                        />

                      </div>}
                    </div>
                  </div>
                </div>

                {/* <!-- item 4 --> */}
                <div className="tpv-settings-option  sm:flex justify-between items-center pt-[26px] pb-[23px] px-9 border-[#F4F5F9] border-b-2 last:border-0">
                  <div className="tpv-settings-option-content mb-4 sm:mb-0">
                    <h4 className="text-lg mb-0">Swatches Style</h4>
                    <p className="mb-0">
                      Swatches shape like rounded, square or default
                    </p>
                  </div>
                  {/* <!-- select option --> */}
                  <div className="tpv-settings-option-select tp-tooltip-select tp-style-select">
                    <select onChange={handleStyle} className={swatchStyle} value={swatchStyle}>
                      <option value={"square"}>Square</option>
                      <option value={"rounded"}>Rounded</option>
                    </select>
                  </div>
                </div>

                {/* <!-- Swatch Size  --> */}
                <div className="tpv-settings-option md:flex justify-between items-center pt-[26px] pb-[23px] px-9 border-[#F4F5F9] border-b-2 last:border-0">
                  <div className="tpv-settings-option-content mb-4 md:mb-0">
                    <h4 className="text-lg mb-0">Swatch Size</h4>
                    <p className="mb-3">
                      Give a size in number it will be given as height and width (px). Default:
                      <code className="bg-[#F7F9FA] text-[#303136] h-7 px-2 inline-block">
                        26px
                      </code>
                    </p>
                    <Button
                      isSmall={true}
                      variant={"primary"}
                      onClick={handleSwatchSize}
                    >Save</Button>
                  </div>

                  <div className="tpv-settings-option-input">
                    <input
                      type="number"
                      min={10}
                      value={swatchSize}
                      className="tpv-outline-0 shadow-none w-[200px] h-10 px-4 text-[#303136] border-2 border-[#EFEFEF] rounded-md focus:border-theme"
                      onChange={(e) => setSwatchSize(e.target.value)}
                    />
                  </div>
                </div>
              </div>
            )}

            {settingActive === "shop-archive" && (
              <div className="tpv-settings-shop">
                {/* <!-- item 1 --> */}
                <div className="tpv-settings-option md:flex justify-between items-center pt-[26px] pb-[23px] px-9 border-[#F4F5F9] border-b-2 last:border-0">
                  <div className="tpv-settings-option-content mb-4 md:mb-0">
                    <h4 className="text-lg mb-0">Enable</h4>
                    <p className="mb-0">
                      Enable swatches for shop/ archive page.
                    </p>
                  </div>
                  {/* <!-- switch --> */}
                  <div className="tpv-settings-option-switch">
                    <div
                      className="flex md:justify-center items-center"
                    >
                      <Switch
                        onChange={handleSwatchesToggle}
                        checked={swatch}
                        className={`react-switch ${swatch?'active':''}`}
                        uncheckedIcon={false}
                        checkedIcon={false}
                        id="material-switch"
                      />
                    </div>
                  </div>
                </div>


                {/* <!-- Swatch Label --> */}
                <div className="tpv-settings-option md:flex justify-between items-center pt-[26px] pb-[23px] px-9 border-[#F4F5F9] border-b-2 last:border-0">
                  <div className="tpv-settings-option-content mb-4 md:mb-0">
                    <h4 className="text-lg mb-0">Swatch label</h4>
                    <p className="mb-0">
                      Show/Hide swatches label for shop/ archive page.
                    </p>
                  </div>
                  {/* <!-- switch --> */}
                  <div className="tpv-settings-option-switch">
                    <div
                      className="flex md:justify-center items-center"
                    >
                      <Switch
                        onChange={handleSwatcheLabel}
                        checked={swatchLabel}
                        className={`react-switch ${swatchLabel?'active':''}`}
                        uncheckedIcon={false}
                        checkedIcon={false}
                        id="material-switch"
                      />
                    </div>
                  </div>
                </div>

                {/* <!-- item 2 --> */}
                <div className="tpv-settings-option md:flex justify-between items-center pt-[26px] pb-[23px] px-9 border-[#F4F5F9] border-b-2 last:border-0">
                  <div className="tpv-settings-option-content mb-4 md:mb-0">
                    <h4 className="text-lg mb-0">Position</h4>
                    <p className="mb-0">
                      Swatches position on archive page. You also can use the
                      shortcode. <div></div> <strong>Note:</strong> please use this shortcode inside woocommerce loop:{" "}
                      <code className="bg-[#F7F9FA] text-[#303136] h-7 px-2 inline-block">
                        [pure_wc_swatches]
                      </code>
                    </p>
                  </div>
                  {/* <!-- select option --> */}
                  <div className="tpv-settings-option-select tp-tooltip-select tp-position-select">
                    <select onChange={handleSwatchPosition} className={swatchPosition} value={swatchPosition}>
                      <option value={"woocommerce_after_shop_loop_item_title"}>After Title</option>
                      <option value={"woocommerce_after_shop_loop_item"}>After Price</option>
                    </select>
                  </div>
                </div>


                {/* <!-- Swatch Alignments --> */}
                <div className="tpv-settings-option md:flex justify-between items-center pt-[26px] pb-[23px] px-9 border-[#F4F5F9] border-b-2 last:border-0">
                  <div className="tpv-settings-option-content mb-4 md:mb-0">
                    <h4 className="text-lg mb-0">Swatch alignments</h4>
                    <p className="mb-0">
                      Swatches alignments in shop loop. Adjust the alignment according to your theme style.
                    </p>
                  </div>
                  {/* <!-- select option --> */}
                  <div className="tpv-settings-option-select tp-tooltip-select tp-position-select">
                    <select onChange={handleSwatchAlignments} className={swatchAlignments} value={swatchAlignments}>
                      <option value={"left"}>Left</option>
                      <option value={"right"}>Right</option>
                      <option value={"center"}>Center</option>
                    </select>
                  </div>
                </div>
              </div>
            )}
          </div>
        </div>
      </div>
    </div>
  );
};

export default Setting;
