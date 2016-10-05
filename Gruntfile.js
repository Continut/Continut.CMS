'use strict';

module.exports = function (grunt) {
    // load all grunt tasks
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.initConfig({
        watch: {
            // if any .less file changes in any of the "Less" directories or subdirectories, run our "less" task
            files: "Extensions/System/Backend/Resources/Public/Less/**/*",
            tasks: ["less"]
        },
        // "less"-task configuration
        less: {
            // production config is also available
            development: {
                options: {
                    // Specifies directories to scan for @import directives when parsing.
                    // Default value is the directory of the source, which is probably what you want.
                    paths: ["Less/"],
                    compress: false
                },
                files: {
                    "Extensions/System/Backend/Resources/Public/Css/local/backend.css": "Extensions/System/Backend/Resources/Public/Less/local/backend.less"
                }
            },
        },
    });
     // the default task (running "grunt" in console) is "watch"
     grunt.registerTask('default', ['watch']);
};
