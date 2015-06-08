var gulp = require('gulp');
var phpunit = require('gulp-phpunit');
var phpspec = require('gulp-phpspec');
var notify = require('gulp-notify');
var run = require('gulp-run');

gulp.task('test', function(){
    run('clear', {'usePowerShell': true}).exec('Vinyl', function(){

        //gulp.src('phpunit.xml').pipe(phpunit('./vendor/bin/phpunit'))
        //gulp.src('phpunit.xml').pipe(phpunit('.\\vendor\\phpunit\\phpunit\\phpunit'))
        //gulp.src('phpunit.xml').pipe(phpunit('php vendor/phpunit/phpunit/phpunit'))
        //gulp.src('phpunit.xml').pipe(phpunit('.\\bin\\phpunit'))
        gulp.src('phpunit.xml').pipe(phpunit('.\\bin\\phpunit', {silent: true}))
        //gulp.src('spec/**/*.php')
        //    .pipe(phpspec('', { notify: true}))
            .on('error', notify.onError({
                title: 'WTF???',
                message: 'The tests failed',
                icon: __dirname + '/node_modules/gulp-phpspec/assets/test-fail.png'
                //sound: true,
                //time: 2000
            }))
            .pipe(notify({
                title: 'All done!',
                message: 'The tests passed',
                icon: __dirname + '/node_modules/gulp-phpspec/assets/test-pass.png'
                //sound: true,
                //time: 2000
            }));
    });
});

gulp.task('watch', function(){
    //gulp.watch(['spec/**/*.php', 'src/**/*.php'], ['test']);
    gulp.watch(['tests/**/*.php', 'src/**/*.php'], ['test']);
});

gulp.task('default', ['test', 'watch']);


gulp.task('phpunit', function() {
    gulp.src('phpunit.xml').pipe(phpunit('.\\bin\\phpunit', {silent: true}))
    //run('phpunit').exec();
});