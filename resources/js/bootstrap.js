/**
 * Bootstrap file for Todo App
 * This file includes any global JavaScript setup needed for the application
 */

// Import global dependencies if needed
// window._ = require('lodash');

// Set up any global configurations
window.axios = window.axios || {};

// Console log for development
if (process.env.NODE_ENV === "development") {
    console.log("Todo App Bootstrap loaded");
}
