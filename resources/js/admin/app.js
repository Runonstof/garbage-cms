//admin dashboard jsS

require('./../forms/form');

window.Axios = require('axios');

window.Axios.defaults.headers.post['X-Csrf-Token'] = $('meta[name=csrf_token]').attr('content');