import React from "react";
import logo from '../assets/img/logo/logo.png';

const Sidebar = ({ handleActiveTab,activeTav }) => {
  return (
    <div className="tpv-dashboard-sidebar sm:ml-2 xl:ml-[30px] mr-2 sm:mr-0">
      <div className="tpv-dashboard-logo mt-10 mb-10">
        <img src={logo} alt="themepure-logo" />
      </div>
      <div className="tpv-dashboard-tab">
        <h4 className="mb-10">Pure Variation Swatches For WooCommerce</h4>
        <div className="tpv-dashboard-tab-btn mb-1">
          <button
           onClick={() => handleActiveTab("welcome")}
            type="submit"
            className={`text-[15px] group rounded-[12px] p-[4px] w-full sm:w-[200px] text-left block hover:text-theme hover:bg-pink ${
              activeTav === 'welcome'
                ? "text-theme active bg-pink font-medium"
                : "text-text4 bg-white font-normal"
            }`}
          >
            <span
              className={`tpv-dashboard-icon-bg group-hover:bg-white6 w-[48px] h-[48px] leading-[48px] inline-block mr-3 text-center ${
                activeTav === 'welcome' ? "bg-white6" : "bg-white"
              }`}
            >
              <svg
                width="16"
                height="16"
                viewBox="0 0 16 16"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  opacity="0.7"
                  d="M16 5.216V1.584C16 0.456 15.488 0 14.216 0H10.984C9.71201 0 9.20001 0.456 9.20001 1.584V5.208C9.20001 6.344 9.71201 6.792 10.984 6.792H14.216C15.488 6.8 16 6.344 16 5.216Z"
                  fill="#FB9CA4"
                />
                <path
                  d="M16 14.216V10.984C16 9.71195 15.488 9.19995 14.216 9.19995H10.984C9.71201 9.19995 9.20001 9.71195 9.20001 10.984V14.216C9.20001 15.488 9.71201 16 10.984 16H14.216C15.488 16 16 15.488 16 14.216Z"
                  fill="#3C42E0"
                />
                <path
                  d="M6.8 5.216V1.584C6.8 0.456 6.288 0 5.016 0H1.784C0.512 0 0 0.456 0 1.584V5.208C0 6.344 0.512 6.792 1.784 6.792H5.016C6.288 6.8 6.8 6.344 6.8 5.216Z"
                  fill="#3C42E0"
                />
                <path
                  opacity="0.7"
                  d="M6.8 14.216V10.984C6.8 9.71195 6.288 9.19995 5.016 9.19995H1.784C0.512 9.19995 0 9.71195 0 10.984V14.216C0 15.488 0.512 16 1.784 16H5.016C6.288 16 6.8 15.488 6.8 14.216Z"
                  fill="#FB9CA4"
                />
              </svg>
            </span>
            Welcome
          </button>
        </div>
        <div className="tpv-dashboard-tab-btn mb-1">
          <button
            onClick={() => handleActiveTab("setting")}
            type="submit"
            className={`text-[15px] group rounded-[12px] p-[4px] w-full sm:w-[200px] text-left block hover:text-theme hover:bg-pink ${
              activeTav === 'setting'
                ? "text-theme active bg-pink font-medium"
                : "text-text4 bg-white font-normal"
            }`}
          >
            <span
              className={`tpv-dashboard-icon-bg group-hover:bg-white6 w-[48px] h-[48px] leading-[48px] inline-block mr-3 text-center ${
                activeTav === 'setting' ? "bg-white6" : "bg-white"
              }`}
            >
              <svg
                width="18"
                height="17"
                viewBox="0 0 18 17"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  opacity="0.4"
                  d="M0 9.28237L0 7.69916C0 6.76363 0.764618 5.99002 1.70915 5.99002C3.33733 5.99002 4.003 4.83859 3.18441 3.4263C2.71664 2.6167 2.9955 1.56423 3.81409 1.09646L5.37031 0.205908C6.08096 -0.21688 6.9985 0.0349938 7.42129 0.745638L7.52024 0.916553C8.32983 2.32885 9.66117 2.32885 10.4798 0.916553L10.5787 0.745638C11.0015 0.0349938 11.919 -0.21688 12.6297 0.205908L14.1859 1.09646C15.0045 1.56423 15.2834 2.6167 14.8156 3.4263C13.997 4.83859 14.6627 5.99002 16.2909 5.99002C17.2264 5.99002 18 6.75463 18 7.69916V9.28237C18 10.2179 17.2354 10.9915 16.2909 10.9915C14.6627 10.9915 13.997 12.1429 14.8156 13.5552C15.2834 14.3738 15.0045 15.4173 14.1859 15.8851L12.6297 16.7756C11.919 17.1984 11.0015 16.9465 10.5787 16.2359L10.4798 16.065C9.67016 14.6527 8.33883 14.6527 7.52024 16.065L7.42129 16.2359C6.9985 16.9465 6.08096 17.1984 5.37031 16.7756L3.81409 15.8851C2.9955 15.4173 2.71664 14.3648 3.18441 13.5552C4.003 12.1429 3.33733 10.9915 1.70915 10.9915C0.764618 10.9915 0 10.2179 0 9.28237Z"
                  fill="#FB9CA4"
                />
                <path
                  d="M8.99553 11.4142C10.6102 11.4142 11.9191 10.1053 11.9191 8.49068C11.9191 6.87605 10.6102 5.56714 8.99553 5.56714C7.3809 5.56714 6.07199 6.87605 6.07199 8.49068C6.07199 10.1053 7.3809 11.4142 8.99553 11.4142Z"
                  fill="#3C42E0"
                />
              </svg>
            </span>
            Settings
          </button>
        </div>
        <div className="tpv-dashboard-tab-btn mb-1">
          <button
            onClick={() => handleActiveTab("how-use")}
            type="submit"
            className={`group text-[15px] rounded-[12px] p-[4px] w-full sm:w-[200px] text-left block hover:text-theme hover:bg-pink ${
              activeTav === 'how-use'
                ? "text-theme active bg-pink font-medium"
                : "text-text4 bg-white font-normal"
            }`}
          >
            <span
              className={`tpv-dashboard-icon-bg group-hover:bg-white6 w-[48px] h-[48px] leading-[48px] inline-block mr-3 text-center ${
                activeTav === 'how-use' ? "bg-white6" : "bg-white"
              }`}
            >
              <svg
                width="18"
                height="18"
                viewBox="0 0 18 18"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  opacity="0.4"
                  d="M9 18C13.9706 18 18 13.9706 18 9C18 4.02944 13.9706 0 9 0C4.02944 0 0 4.02944 0 9C0 13.9706 4.02944 18 9 18Z"
                  fill="#FB9CA4"
                />
                <path
                  d="M6.38998 8.99989V7.66789C6.38998 5.94889 7.60498 5.25589 9.08998 6.11089L10.242 6.77689L11.394 7.44289C12.879 8.29789 12.879 9.70189 11.394 10.5569L10.242 11.2229L9.08998 11.8889C7.60498 12.7439 6.38998 12.0419 6.38998 10.3319V8.99989Z"
                  fill="#3C42E0"
                />
              </svg>
            </span>
            How to Use
          </button>
        </div>
        <div className="tpv-goto-pro none hidden">
          <a
            href="#"
            className="font-medium text-[15px] text-theme p-[4px] group"
          >
            <span className="w-[48px] h-[48px] leading-[48px] text-center inline-block mr-3">
              <svg
                className="translate-y-[-2px]"
                width="18"
                height="19"
                viewBox="0 0 18 19"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M13.2436 15.2271H4.82146C4.44515 15.2271 4.02404 14.9314 3.8986 14.573L0.189278 4.19763C-0.339346 2.71032 0.278875 2.25337 1.55116 3.16726L5.04545 5.66703C5.62783 6.07021 6.29085 5.86414 6.54172 5.21008L8.11863 1.00797C8.62038 -0.33599 9.45363 -0.33599 9.95538 1.00797L11.5323 5.21008C11.7832 5.86414 12.4462 6.07021 13.0196 5.66703L16.2989 3.32854C17.6966 2.32505 18.3686 2.83575 17.7951 4.45746L14.1754 14.5909C14.041 14.9314 13.6199 15.2271 13.2436 15.2271Z"
                  fill="#FB9CA4"
                />
                <path
                  d="M4.10474 17.9329H13.9604"
                  stroke="#3C42E0"
                  strokeWidth="1.5"
                  strokeLinecap="round"
                  strokeLinejoin="round"
                />
                <path
                  d="M6.79266 10.7651H11.2725"
                  stroke="#3C42E0"
                  strokeWidth="1.5"
                  strokeLinecap="round"
                  strokeLinejoin="round"
                />
              </svg>
            </span>
            Go to Pro
            <svg
              className="ml-1 group-hover:ml-2 transition-all duration-300 ease"
              width="14"
              height="11"
              viewBox="0 0 14 11"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M1.12134 5.3269H12.429"
                stroke="#3C42E0"
                strokeWidth="1.5"
                strokeLinecap="round"
                strokeLinejoin="round"
              />
              <path
                d="M8.7944 1L13.1213 5.32692L8.7944 9.65385"
                stroke="#3C42E0"
                strokeWidth="1.5"
                strokeLinecap="round"
                strokeLinejoin="round"
              />
            </svg>
          </a>
        </div>
      </div>
    </div>
  );
};

export default Sidebar;
