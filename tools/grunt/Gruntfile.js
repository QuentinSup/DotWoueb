module.exports = function(grunt) {

	grunt.file.defaultEncoding = 'utf8';
	grunt.file.preserveBOM = false;
	
  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('grunt.json'),
    typescript: {
    	snapshot: {
    		src: ["./definitions/**/*.d.ts", "<%= pkg.basedir %>/<%= grunt.option('app') %>/**/*.ts"],
    		options: { 
    			sourceMap: true,
    			declaration: true,
    			comments: true
    		}
    	},
    },
    uglify: {
    	release: {
			files: [{
		          expand: true,
		          cwd: "<%= pkg.targetDir %>",
		          src: "**/*.js",
		          dest:"<%= pkg.targetDir %>"
		      }]
    	}
    },
    htmlmin: {                                     
        release: {    
			options: {
				minifyJS: true,
				minifyCSS: true,
				collapseWhitespace: true,
				conservativeCollapse: true,
				ignoreCustomComments: [/^\s+ko/, /\/ko\s+$/]
			},
			files: [{
		      expand: true,
		      cwd: "<%= pkg.targetDir %>",
		      src: ["**/*.{html,css}"],
		      dest:"<%= pkg.targetDir %>"
			}]
        }
      },
      less: {
			snapshot: {
			    options: {
		    		cleancss: false,
		    		ieCompat: true,
		    		compress: false
			    },
			    files: [{
			      expand: true,
			      cwd: "<%= pkg.basedir %>/<%= grunt.option('app') %>/webapp/",
			      src: ["**/*.less", "!**/_*.less", '!**/vendors{,/**/*}'],
			      ext: ".css"
				}]
			},
			release: {
			    options: {
		    		cleancss: true,
		    		ieCompat: true,
		    		compress: true
			    },
			    files: [{
			      expand: true,
			      cwd: "<%= pkg.basedir %>resources",
			      src: ["**/*.less", "!**/_*.less", '!**/vendors{,/**/*}'],
			      dest:"<%= pkg.targetDir %>",
			      ext: ".css"
				}]
			}
	    },
	    copyto: {
	    	snapshot: {
	    		options: {
	    			encoding: "<%= pkg.encoding %>",
	    			ignore: [
				         '**/webkit{,/**/*}', 	// Répertoire TYPESCRIPT
				         '**/vendors{,/**/*}', 	// Répertoire includes
				         '**/*.scc', 	// Fichiers VSS
				         '**/*.ts', 	// Fichiers Typescript
				         '**/*.less', 	// Fichiers Less
				         '**/*.inc.*',  // Fichiers includes
				         '**/LocaleInfos.js'
	    			]
	    		},
	    		files: [
	    		    {
	    		       expand: true,
	    		       cwd: "<%= pkg.basedir %>/resources",
	    		       src: ['**/*'],
	    		       dest: "<%= pkg.targetDir %>"
    		        }
	    		]
	    	},
	    	release: {
	    		options: {
	    			encoding: "<%= pkg.encoding %>",
	    			ignore: [
				         '**/webkit{,/**/*}', 	// Répertoire TYPESCRIPT
				         '**/vendors{,/**/*}',  // Répertoire includes
				         '**/*.ts', 			// Fichiers Typescript
				         '**/*.less', 			// Fichiers Less
				         '**/*.scc', 			// Fichiers VSS
				         '**/*.inc.*',  		// Fichiers includes
				         '**/LocaleInfos.js'
	    			]
	    		},
	    		files: [
	    		    {
	    		       expand: true,
	    		       cwd: "<%= pkg.basedir %>/resources",
	    		       src: ['**/*'],
	    		       dest: "<%= pkg.targetDir %>"
    		        }
	    		]
	    	}
	    },
		showtime: {
			start: {
				msg: "Started at: "
			},
			end: {
				msg: "Ended at: "
			}
		}
  });
  
  
  // Load the plugin that provides the "uglify" task.
  grunt.loadNpmTasks('grunt-typescript');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-htmlmin');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-copy-to');
  grunt.loadNpmTasks('grunt-include-replace');
  grunt.loadNpmTasks('grunt-contrib-clean');
  
  // Default task(s).
  //grunt.registerTask('default', ['tsc']);
  grunt.registerTask('conf', 'Configuration', function() {
	  grunt.log.writeln("Configuration: edit 'grunt.json' file to change values");
	  grunt.log.writeln("App name: " + grunt.option('app'));
	  grunt.log.writeln("Base dir: " + grunt.config.get('pkg.basedir'));
	  grunt.log.writeln("Target dir: " + grunt.config.get('pkg.targetDir'));
  });
  
  grunt.registerMultiTask('showtime', 'Display time', function() {
	  grunt.log.writeln(this.data.msg + (new Date().toLocaleString()));
  });

  grunt.registerTask('snapshot', 'Resources generation [SNAPSHOT]', ['conf', 'showtime:start', 'typescript:snapshot', 'less:snapshot', 'showtime:end']);
  //grunt.registerTask('release', 'Resources generation [RELEASE]', ['conf', 'showtime:start', 'clean:target', 'copyto:release', 'includereplace:vendorcss', 'includereplace:vendorjs', 'typescript:releasefwk', 'concat:webkit', 'concat:webkit_dependencies', 'uglify:release', 'htmlmin:release', 'clean:dependencies', 'less:release', 'showtime:end']);

};