$(document).ready(function () {
  var isClosed;

  runInit();

}); // end document.ready
$(window).load(function() {
  fileInput();
  selectpicker();
  slider();
  datepicker();
});
/**
 * Task yang dijalankan ketika document ready (page specific)
 * @return {[type]} [description]
 */
$(document).ready(function () {
}); // end document.ready

/**
 * Kumpulan task yang dijalankan ketika document ready
 * @return {[type]} [description]
 */
function runInit() {

  runInitAndResize();

  // on window resize event
  $(window).resize(function (){
      var delay;
      clearTimeout(delay);
      delay = setTimeout(runResizeTask(), 250);
  });
}

/**
 * Kumpulan task yang dijalankan ketika window diresize
 * @return {[type]} [description]
 */
function runResizeTask() {
  runInitAndResize();
}

/**
 * Kumpulan task yang dijalankan ketika document ready dan window diresize
 * @return {[type]} [description]
 */
function runInitAndResize() {
  setContentMinHeight();
}

function fileInput() {
  $('input[type=file]').bootstrapFileInput();
  $('.file-inputs').bootstrapFileInput();
  $('.file-input-name').text('No File Chosen');
}

function selectpicker() {
  $('.selectpicker').selectpicker();
}

function slider() {
  $(".slider").slider({});
}

function datepicker() {
  $('.date').datetimepicker();
}

function setContentMinHeight() {
  var navHeight = $('nav').height();
  var footerHeight = $('footer').height();
  var windowHeight = $(window).height();
  $('#content').css('min-height', windowHeight - (footerHeight + navHeight + 25) );
}