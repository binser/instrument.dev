var gulp = require('gulp'),
    spritesmith = require('gulp.spritesmith'),
    imagemin = require('gulp-imagemin');

gulp.task('sprite', function() {
    var spriteData =
        gulp.src('./src/Binser/InstrumentBundle/Resources/public/images/social/*.*')
            .pipe(spritesmith({
                imgName: 'social_sprite.png',
                cssName: 'social_sprite.css'
            }));

    spriteData.img.pipe(gulp.dest('./src/Binser/InstrumentBundle/Resources/public/images/'));
    spriteData.css.pipe(gulp.dest('./src/Binser/InstrumentBundle/Resources/public/css/'));
});