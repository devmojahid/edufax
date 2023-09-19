import React,{useState} from "react";
import ModalVideo from "react-modal-video";
// internal
import refresh from "../assets/img/icon/refresh.png";
import how_use_img from "../assets/img/how/how-to-use.jpg";

const HowToUse = () => {
  const [isVideoOpen, setIsVideoOpen] = useState(false);
  return (
    <>
      <div className="tpv-settings-page bg-teal-700 bg-gray rounded-3xl px-[1rem] sm:px-[1.5rem] md:px-[2.725rem] lg:px-[50px] xl:px-[80px] pb-[62px] py-11">
        <div className="grid">
          <div className="grid-cols-12">
            <div className="tpv-dashboard-header flex justify-between items-center mb-[37px]">
              <h3 className="text-5xl font-medium mb-0">How to use</h3>

              <div className="tpv-dashboard-refresh">
                <button type="button">
                  <img src={refresh} alt="refresh" />
                </button>
              </div>
            </div>
          </div>
          <div className="grid-cols-12">
            <div className="tpv-htu-thumb rounded-2xl overflow-hidden mb-10">
              <img
                src={how_use_img}
                alt="how-to-use"
                onClick={() => setIsVideoOpen(true)}
                className="cursor-pointer"
              />
            </div>
          </div>
          <div className="grid-cols-12">
            <div className="tpv-htu-content">
              <h3 className="font-semibold text-4xl mb-[10px]">How to Use</h3>
              <p className="text-text2 text-[15px] mb-6">
                A simple and beautiful swatch plugin for shop. You can easily use this. Just select options from the dropdown and save. It helps your customer to select their choise without any hesitation.
              </p>

              <div className="tpv-htu-list mb-[30px]">
                <ul>
                  <li className="text-text2 text-lg pl-4 mb-[5px] last:mb-0 relative after:absolute after:content-[''] after:left-0 after:top-[14px] after:translate-y-[-50%] after:w-1 after:h-1 after:rounded-full after:bg-text2">
                    Add color options for Variable Product Attribute Variations.
                  </li>

                  <li className="text-text2 text-lg pl-4 mb-[5px] last:mb-0 relative after:absolute after:content-[''] after:left-0 after:top-[14px] after:translate-y-[-50%] after:w-1 after:h-1 after:rounded-full after:bg-text2">
                    Add image options for Variable Product Attribute Variations.
                  </li>
                  <li className="text-text2 text-lg pl-4 mb-[5px] last:mb-0 relative after:absolute after:content-[''] after:left-0 after:top-[14px] after:translate-y-[-50%] after:w-1 after:h-1 after:rounded-full after:bg-text2">
                    Create rounded and square styles.
                  </li>
                  <li className="text-text2 text-lg pl-4 mb-[5px] last:mb-0 relative after:absolute after:content-[''] after:left-0 after:top-[14px] after:translate-y-[-50%] after:w-1 after:h-1 after:rounded-full after:bg-text2">
                    Placement of swatch and tooltip.
                  </li>
                </ul>
              </div>

              <div className="tpv-htu-btn">
                <a href="https://themepure.net/plugins/woocommerce-variation-swatches/docs/" target="_blank" className="tpv-btn-purple hover:text-white">
                  See Our Docs
                </a>
              </div>
            </div>
          </div>
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
};

export default HowToUse;
