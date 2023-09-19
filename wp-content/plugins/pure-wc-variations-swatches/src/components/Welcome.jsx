import React, { useState } from "react";
import ModalVideo from "react-modal-video";
// internal
import refresh from "../assets/img/icon/refresh.png";
import banner from "../assets/img/welcome/welcome-banner.jpg";
import feature_1 from "../assets/img/features/features-1.png";
import feature_2 from "../assets/img/features/features-2.png";
import feature_3 from "../assets/img/features/features-3.png";

export default function Welcome() {
  const [isVideoOpen, setIsVideoOpen] = useState(false);
  return (
    <>
      <div className="tpv-welcome-page bg-gray rounded-3xl px-[1rem] sm:px-[1.5rem] md:px-[2.725rem] lg:px-[50px] xxl:px-[50px] xxxl:px-[80px] pb-[62px] py-11">
        <div className="grid">
          <div className="grid-cols-12">
            <div className="tpv-dashboard-header sm:flex justify-between items-center mb-[37px]">
              <h3 className="text-5xl font-medium mb-4 sm:mb-0">Welcome</h3>

              <div className="tpv-dashboard-refresh">
                <button type="button">
                  <img
                    src={refresh}
                    alt="refresh"
                  />
                </button>
              </div>
            </div>
          </div>
        </div>
        <div className="grid-cols-12">
          <div className="col-span-12">
            <div className="tpv-welcome-banner rounded-xl overflow-hidden mb-10">
              <img
                onClick={() => setIsVideoOpen(true)}
                src={banner}
                alt="welcome-banner"
                className="cursor-pointer"
              />
            </div>
          </div>
        </div>
        <div className="tpv-welcome-feature mb-5">
          <div className="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-2 xxl:grid-cols-3 gap-8 items-center">
            <div className="tpv-welcome-feature-item lg:block xl:flex items-start px-9 pt-[26px] pb-[10px] bg-white rounded-xl">
              <div className="tpv-welcome-feature-icon mb-4">
                <span>
                  <img
                    className="mr-[14px] max-w-[24px]"
                    src={feature_1}
                    alt="features-1"
                  />
                </span>
              </div>
              <div className="tpv-welcome-feature-content">
                <h3 className="tpv-welcome-feature-title text-[17px] mb-1">
                  Easy to use
                </h3>
                <p className="leading-6">
                  Are you looking for a simple variation swatch. Then its made for you.
                </p>
              </div>
            </div>
            <div className="tpv-welcome-feature-item lg:block xl:flex items-start px-9 pt-[26px] pb-[10px] bg-white rounded-xl">
              <div className="tpv-welcome-feature-icon mb-4">
                <span>
                  <img
                    className="mr-[14px] max-w-[24px]"
                    src={feature_2}
                    alt="features-1"
                  />
                </span>
              </div>
              <div className="tpv-welcome-feature-content">
                <h3 className="tpv-welcome-feature-title text-[17px] mb-1">
                  Free but Powerful
                </h3>
                <p className="leading-6">
                  It has a lot of features which makes your shop great. Just install and Enjoy.
                </p>
              </div>
            </div>
            <div className="tpv-welcome-feature-item lg:block xl:flex items-start px-9 pt-[26px] pb-[10px] bg-white rounded-xl">
              <div className="tpv-welcome-feature-icon mb-4">
                <span>
                  <img
                    className="mr-[14px] max-w-[24px]"
                    src={feature_3}
                    alt="features-1"
                  />
                </span>
              </div>
              <div className="tpv-welcome-feature-content">
                <h3 className="tpv-welcome-feature-title text-[17px] mb-1">
                  Unlimited Option
                </h3>
                <p className="leading-6">
                  You can use swatch as your wish. It's build with unlimited functionality.
                </p>
              </div>
            </div>
          </div>
        </div>
        <div className="tpv-welcome-website">
          <p>
            <span className="inline-block translate-y-[-2px] mr-1">
              <svg
                width="16"
                height="16"
                viewBox="0 0 16 16"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M8.80972 7.19019C10.6003 8.98072 10.6003 11.8774 8.80972 13.66C7.01919 15.4426 4.1225 15.4505 2.33992 13.66C0.557342 11.8695 0.549384 8.97276 2.33992 7.19019"
                  stroke="currentColor"
                  strokeWidth="1.5"
                  strokeLinecap="round"
                  strokeLinejoin="round"
                />
                <path
                  d="M6.84407 9.15589C4.98191 7.29373 4.98191 4.26972 6.84407 2.3996C8.70622 0.529489 11.7302 0.537447 13.6004 2.3996C15.4705 4.26176 15.4625 7.28578 13.6004 9.15589"
                  stroke="currentColor"
                  strokeWidth="1.5"
                  strokeLinecap="round"
                  strokeLinejoin="round"
                />
              </svg>
            </span>
            <span className="text-text2">Website : </span>
            <a
              className="text-theme underline"
              href="https://themepure.net/plugins/woocommerce-variation-swatches/shop/"
            >
              https://themepure.net/plugins/woocommerce-variation-swatches/shop/
            </a>
          </p>
        </div>
      </div>

      <ModalVideo
        channel="youtube"
        autoplay
        isOpen={isVideoOpen}
        videoId="EW4ZYb3mCZk"
        onClose={() => setIsVideoOpen(false)}
      />
    </>
  );
}
