var gulp = require('gulp');
var phpspec = require('gulp-phpspec');
var notify = require('gulp-notify');
var run = require('gulp-run');

gulp.task('test', function(){
    run('clear', {'usePowerShell': true}).exec('Vinyl', function(){
        gulp.src('spec/**/*.php')
            .pipe(phpspec('', { notify: true}))
            .on('error', notify.onError({
                title: 'WTF???',
                message: 'The phpspec tests failed',
                icon: __dirname + '/node_modules/gulp-phpspec/assets/test-fail.png'
                //sound: true,
                //time: 2000
            }))
            .pipe(notify({
                title: 'All done!',
                message: 'The phpspec tests passed',
                icon: __dirname + '/node_modules/gulp-phpspec/assets/test-pass.png'
                //sound: true,
                //time: 2000
            }));
    });
});

gulp.task('watch', function(){
    gulp.watch(['spec/**/*.php', 'src/**/*.php'], ['test']);
});

gulp.task('default', ['test', 'watch']);