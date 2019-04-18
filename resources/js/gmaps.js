// Personal API Key
const API_KEY = 'AIzaSyBqegCueGlYzeJcw3Aqt9XU9PqFwbpJ7jo';
const CALLBACK_NAME = 'gmapsCallback';

let initialized = !!window.google;
let resolveInitPromise;
let rejectInitPromise;
// Promise to handle initiation
// status of the google maps script
const initPromise = new Promise((resolve, reject) => {
    resolveInitPromise = resolve;
    rejectInitPromise = reject;
});

export default function init() {
    // If Google Maps already is initialized the `initPromise` should be resolved.
    if (initialized) return initPromise;

    initialized = true;
    // Callback function is called by Google Maps script
    // if it is loaded successfully 
    window[CALLBACK_NAME] = () => resolveInitPromise(window.google);
    // Inject the script tag into our HTML to load the Google Maps script.
    const script = document.createElement(`script`);
    script.async = true;
    script.defer = true;
    script.src = `https://maps.googleapis.com/maps/api/js?key=${API_KEY}&callback=${CALLBACK_NAME}`;
    script.onerror = rejectInitPromise;
    document.querySelector(`head`).appendChild(script);

    return initPromise;
}
