module.exports = function(grunt) {
  require('jit-grunt')(grunt);

  grunt.initConfig({
    less: {
      development: {
        options: {
          /*compress: true,
          yuicompress: true,*/
          optimization: 2
        },
        files: {
          "custom/css/main.css": "custom/less/main.less",
          "custom/css/result.css": "custom/less/result.less",
          "custom/css/logged.css": "custom/less/logged.less", 
          "custom/css/product.css": "custom/less/product.less",
          "custom/css/cart.css": "custom/less/cart.less",
          "custom/css/order.css": "custom/less/order.less",
          "custom/css/interface.css": "custom/less/interface.less"// destination file and source file
        }
      }
    },
    watch: {
      styles: {
        files: ['custom/less/**/*.less'], // which files to watch
        tasks: ['less'],
        options: {
          spawn: true
        }
      }
    }
  });
  grunt.registerTask('default', ['less', 'watch']);
};