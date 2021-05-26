module.exports = function() {
  $.gulp.task('copy', () => {
    return $.gulp.src('dev/root_file/**/*.*')
      .on('error', $.gp.notify.onError(function(error) {
      return {
        title: 'copy',
        message: error.message
      };
    }))
      .pipe($.gulp.dest('build/'));
  });
};
