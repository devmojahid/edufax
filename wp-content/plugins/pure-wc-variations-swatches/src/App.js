import React from "react";
import Welcome from "./components/Welcome";
import Sidebar from "./components/Sidebar";
import Setting from "./components/Setting";
import Wrapper from "./components/Wrapper";
import HowToUse from "./components/HowUse";

/**
 * Import the stylesheet for the plugin.
 */
import '../node_modules/react-modal-video/css/modal-video.css';
import './assets/css/index.css';
import './tailwind.css';

const App = () => {
  const [activeTav, setActiveTab] = React.useState("welcome");
  // handle active tab
  const handleActiveTab = (value) => {
    setActiveTab(value);
  };
  // decide to render
  let content = <Welcome />;
  if (activeTav === "welcome") {
    content = <Welcome />;
  }
  if (activeTav === "setting") {
    content = <Setting />;
  }
  if (activeTav === "how-use") {
    content = <HowToUse />;
  }

  return (
    <Wrapper>
      <main>
        <div class="tpv-dashboard-area p-3 bg-white">
          <div class="container-full">
            <div class="grid grid-cols-12 gap-8" x-data="{tab: 100}">
              <div class="2xl:col-span-3 xl:col-span-3 lg:col-span-3 md:col-span-4 sm:col-span-5 col-span-12">
                <Sidebar
                  handleActiveTab={handleActiveTab}
                  activeTav={activeTav}
                />
              </div>
              <div class="2xl:col-span-9 xl:col-span-9 lg:col-span-9 md:col-span-8 sm:col-span-7 col-span-12">
                <div class="tpv-dashboard-tab-content ml-0 sm:ml-[18px]">
                  {content}
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </Wrapper>
  );
};

export default App;
