module.exports = function() {

  // return $.gulp.src('./dev/static/img/**/*.{png,jpg,gif}') //default
  // var imgPath = 'dev/img/**/*'; //default
  // var imgPath = ['dev/img/**/*','!dev/img/ico/**/*']; // work but still empty folder
  // var imgPath = ['dev/img/**/*', '!dev/img/{ico,ico/**}', '!dev/img/{svg,svg/**}', '!dev/img/favicon/favicon.ico']; // works as it well
  var imgPathDev = ['dev/img/**', '!dev/img/{ico,ico/**}']; // works as it well
  var imgPathBuild = ['dev/img/**', '!dev/img/{ico,ico/**}', '!dev/img/pixelGlass/**']; // works as it well

  $.gulp.task('img:dev', () => {
    return $.gulp.src(imgPathDev)
    .on('error', $.gp.notify.onError(function (error) {
      return {
        title: 'img',
        message: error.message
      };
    }))
    .pipe($.gulp.dest('build/img/'));
  });

  $.gulp.task('img:build', () => {
    return $.gulp.src(imgPathBuild)
    .pipe($.gp.image())
    .pipe($.gulp.dest('build/img/'));
  });
};
