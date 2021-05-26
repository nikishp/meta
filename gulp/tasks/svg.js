module.exports = function() {
  $.gulp.task('svg', () => {
    return $.gulp.src('dev/img/svg/svg_grayscale/*.svg')
      .pipe($.gp.svgmin({
      js2svg: {
        pretty: true
      }
    }))
      .pipe($.gp.cheerio({
      run: function($) {
        $('[fill]').removeAttr('fill');
        $('[stroke]').removeAttr('stroke');
        $('[style]').removeAttr('style');
      },
      parserOptions: { xmlMode: true }
    }))
      .pipe($.gp.replace('&gt;', '>'))
      .pipe($.gp.svgSprite({
      mode: {
        symbol: {
          sprite: "sprite.svg"
        }
      }
    }))
      .pipe($.gulp.dest('build/img/svg'));
  });
  
  $.gulp.task('svg_c', () => {
    return $.gulp.src('dev/img/svg/svg_colored/*.svg')
      .pipe($.gp.svgmin({
      js2svg: {
        pretty: true
      }
    }))
      .pipe($.gp.cheerio({
      run: function($) {
        //$('[fill]').removeAttr('fill');
        //$('[stroke]').removeAttr('stroke');
        $('[style]').removeAttr('style');
      },
      parserOptions: { xmlMode: true }
    }))
      .pipe($.gp.replace('&gt;', '>'))
      .pipe($.gp.svgSprite({
      mode: {
        symbol: {
          sprite: "sprite-colored.svg"
        }
      }
    }))
      .pipe($.gulp.dest('build/img/svg'));
  });
};
