(function (d) {
  d.getElementById('form').onsubmit = function () {
    d.getElementById('submitx').style.display = 'none';
    d.getElementById('loading-main-form').style.display = 'block';
  };
}(document));