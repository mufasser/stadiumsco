(()=>{"use strict";var e={d:(t,a)=>{for(var o in a)e.o(a,o)&&!e.o(t,o)&&Object.defineProperty(t,o,{enumerable:!0,get:a[o]})},o:(e,t)=>Object.prototype.hasOwnProperty.call(e,t),r:e=>{"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})}},t={};e.r(t),e.d(t,{enableFeatures:()=>o,enabledFeatures:()=>r,isFeatureEnabled:()=>a});const a=function(e){return!!self.wpseoFeatureFlags&&self.wpseoFeatureFlags.includes(e)},o=function(e){self.wpseoFeatureFlags||(self.wpseoFeatureFlags=[]),e.forEach((e=>{self.wpseoFeatureFlags.includes(e)||self.wpseoFeatureFlags.push(e)}))},r=function(){return self.wpseoFeatureFlags||[]};(window.yoast=window.yoast||{}).featureFlag=t})();