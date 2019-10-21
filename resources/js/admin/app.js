//admin dashboard jsS

require('./../forms/form');

window.Axios = require('axios');

window.Axios.defaults.csrf_token = $('meta[name=csrf_token]').attr('content');