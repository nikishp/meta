module.exports = function () {

  $.gulp.task('sass:dev', () => {
    return $.gulp.src('dev/sass/main.sass')
      .pipe($.gp.sourcemaps.init())
      .pipe($.gp.sass())
      .on('error', $.gp.notify.onError(function (error) {
        return {
          title: 'sass',
          message: error.message
        };
      }))
      .pipe($.gp.autoprefixer())
      //    .pipe($.gcmq())
      .pipe($.postcss([
        $.mqpacker({
          sort: $.sortCSSmq
        })
      ]))
      //.pipe($.gp.cssnano())
      //.pipe($.gp.cleanCss())
      .pipe($.gp.csso({
        // forceMediaMerge: true
      }))
      //
      .pipe($.gp.sourcemaps.write())
      .pipe($.gulp.dest('build/css/'))
      .pipe($.browserSync.reload({
        stream: true
      }))
  });

  $.gulp.task('sass:build', () => {
    return $.gulp.src('dev/sass/main.sass ')
      .pipe($.gp.sass())
      .pipe($.gp.autoprefixer())
      .pipe($.postcss([
        $.mqpacker({
          sort: $.sortCSSmq
        })
      ]))
      //.pipe($.gcmq())
      //.pipe($.gp.cssnano())
      //.pipe($.gp.cleanCss({
      //format: 'beautify'
      //}))
      .pipe($.gp.csso())
      .pipe($.gulp.dest('build/css/'))
  });

  $.gulp.task('sassLibs:dev', () => {
    return $.gulp.src('dev/sass/libs.sass')
      .pipe($.gp.sourcemaps.init())
      .pipe($.gp.sass())
      // .on('error', $.gp.notify.onError(function (error) {
      //   return {
      //     title: 'sassLibs',
      //     message: error.message
      //   };
      // }))

      .on("error", $.gp.sass.logError)

      .pipe($.postcss([
        $.mqpacker({
          sort: $.sortCSSmq
        })
      ]))
      //.pipe($.gcmq())
      .pipe($.gp.autoprefixer())
      //.pipe($.gp.cssnano())
      //.pipe($.gp.cleanCss())
      .pipe($.gp.csso())
      .pipe($.gp.sourcemaps.write())
      .pipe($.gulp.dest('build/css/'))
      .pipe($.browserSync.reload({
        stream: true
      }));
  });


  $.gulp.task('sassLibs:build', () => {
    return $.gulp.src('dev/sass/libs.sass ')
      .pipe($.gp.sass())
      .pipe($.gp.autoprefixer())
      //.pipe($.gcmq())
      .pipe($.postcss([
        $.mqpacker({
          sort: $.sortCSSmq
        })
      ]))
      //.pipe($.gp.cssnano())
      //.pipe($.gp.cleanCss())
      .pipe($.gp.csso())
      .pipe($.gulp.dest('build/css/'))
  });

};
