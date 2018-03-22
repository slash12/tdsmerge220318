function changePasswordProgressBar(ev) {
  // less than 8 characters
  var wrost = 7,
      // minimum 8 characters
      bad = /(?=.{8,}).*/,
      //Alpha Numeric plus minimum 8
      good = /^(?=\S*?[a-z])(?=\S*?[0-9])\S{8,}$/,
      //Must contain at least one upper case letter, one lower case letter and (one number OR one special char).
      better = /^(?=\S*?[A-Z])(?=\S*?[a-z])((?=\S*?[0-9])|(?=\S*?[^\w\*]))\S{8,}$/,
      //Must contain at least one upper case letter, one lower case letter and (one number AND one special char).
      best = /^(?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9])(?=\S*?[^\w\*])\S{8,}$/,
      password = $(ev.target).val(),
      strength = '0',
      progressClass = 'progress-bar progress-bar-',
      ariaMsg = '0% Complete (danger)',
      $progressBarElement = $('#password-progress-bar');

  if (best.test(password) === true) {
      strength = '100%';
      progressClass += 'success';
      ariaMsg = '100% Complete (success)';
  } else if (better.test(password) === true) {
      strength = '80%';
      progressClass += 'info';
      ariaMsg = '80% Complete (info)';
  } else if (good.test(password) === true) {
      strength = '50%';
      progressClass += 'warning';
      ariaMsg = '50% Complete (warning)';
  } else if (bad.test(password) === true) {
      strength = '30%';
      progressClass += 'warning';
      ariaMsg = '30% Complete (warning)';
  } else if (password.length >= 1 && password.length <= wrost) {
      strength = '10%';
      progressClass += 'danger';
      ariaMsg = '10% Complete (danger)';
  } else if (password.length < 1) {
      strength = '0';
      progressClass += 'danger';
      ariaMsg = '0% Complete (danger)';
  }

  $progressBarElement.removeClass().addClass(progressClass);
  $progressBarElement.attr('aria-valuenow', strength);
  $progressBarElement.css('width', strength);
  $progressBarElement.find('span.sr-only').text(ariaMsg);
}

$(document).ready(function () {
  $(".pwd").first().on('keyup', changePasswordProgressBar);
});
