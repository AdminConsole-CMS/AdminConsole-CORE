/*
 * AdminConsole CORE is released under the GNU General Public License.
 * LICENSE.txt files in the main directory.
*/

tinymce.init({
    selector: 'textarea.tinymce',
	toolbar: ' undo redo | styleselect fontselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor backcolor | charmap | fullscreen  ',
	plugins: [
      'advlist anchor autolink lists charmap preview hr anchor pagebreak ',
      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime nonbreaking',
      'table directionality emoticons paste autoresize'
    ],
	removed_menuitems: 'newdocument', 	 
	branding: false,		
}  );