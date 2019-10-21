//admin dashboard jsS
window.JQuery = require('jquery');
require('bootstrap-notify');

window.Axios = require('axios');

const $ = window.JQuery;


require('./../forms/form');




window.Axios.defaults.headers.post['X-Csrf-Token'] = $('meta[name=csrf_token]').attr('content');