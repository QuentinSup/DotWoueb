<?php /* Smarty version Smarty-3.1.18, created on 2015-09-24 20:31:30
         compiled from "pages\template.html" */ ?>
<?php /*%%SmartyHeaderCode:309955604411ae57334-38972866%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f6495dfdd5aed5d91ced9a6ecaeef96cfe3fc6cf' => 
    array (
      0 => 'pages\\template.html',
      1 => 1443119488,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '309955604411ae57334-38972866',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5604411aeb8dc1_30560119',
  'variables' => 
  array (
    'baseUri' => 0,
    'data' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5604411aeb8dc1_30560119')) {function content_5604411aeb8dc1_30560119($_smarty_tpl) {?><section id="publication" class="section dark">
	<div class="icon-wrap"><span class="icon icon-documents-bookmarks-02"></span></div>
	<h4>Modèle</h4>
	<br />
	<br />
	<div class="container">
		<article class="article-big" style="text-align:left;">
		<form id="form">
			<input id="form-id" name="id" type="hidden" />
			<div class="form-group">
			<input id="form-shortTitle" class="form-control" name="shortTitle" type="text" pattern=".*" maxlength="70" title="Donnez un titre à votre modèle" placeholder="Donnez un titre à votre modèle de publication" required />
			</div>
			<div class="form-group">
			<textarea id="form-text" class="form-control" name="text" rows="15" type="text" pattern=".*" title="Saisir le modèle" placeholder="Saisir le modèle"></textarea>
			</div>
			<fieldset>
				<legend>
					Propriétés
				</legend>
				<div class="form-group">
					<label for="form-catchPhrase">Le descriptif pour la phrase d'accroche (moins de 240 caractères)</label>
					<textarea id="form-catchPhrase" class="form-control limit-text" name="catchPhrase" maxlength="240" rows="4" type="text" pattern=".*" title="Renseignez le descriptif du texte d'accroche (moins de 240 caractères)" placeholder=""></textarea>
					<span id="limit-text-descr">240</span> caractère(s) restant(s)
				</div>
			</fieldset>
			<div class="form-group">
				<button id="btn-draft-action" type="submit" class="btn btn-default">Enregistrer</button>
			</div>
		</form>
		</article>
	</div>
</section>
<script src="assets/js/tinymce/tinymce.min.js"></script>
<script>

	function initMCE() {
		
		tinymce.init({
			setup: function(ed) {
			   ed.on('init', function() 
				{
					this.getDoc().body.style.fontSize = '14px';
					this.getDoc().body.style.fontFamily = 'Arial, sans-serif';
				});
			},
			selector: "#form-text",
			menubar: false,
			paste_as_text: false,
			contextmenu: "paste pastetext link undo redo",
			browser_spellcheck : true,
			plugins: [
				 "advlist autolink link image lists charmap print hr anchor pagebreak",
				 "searchreplace wordcount visualblocks visualchars code media nonbreaking",
				 "save contextmenu directionality emoticons template paste textcolor"
		   ],
			toolbar: "paste pastetext | undo redo | bold italic underline strikethrough | removeformat blockquote forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | code link image media | print"
		 });

	}
	
	(function() {
		
		$('#form-catchPhrase').on('change keyup', function() {
			var $this = $(this);
			if($this.val().length > 240) {
				$this.val($this.val().substr(0, 240));
			}
			
			$('#limit-text-descr').html(240 - $this.val().length);
			
		});
		
		$("#form").on('submit', function() {

			setTimeout(function() {
				
				var $this = $("#form");
				var data = $this.serialize();
				
				if(!$("#form-text").val()) {
					alert("Le texte de votre modèle est vide !");
					return false;
				}
				
				$.post("<?php echo $_smarty_tpl->tpl_vars['baseUri']->value;?>
/?/api/template/<?php if ($_smarty_tpl->tpl_vars['data']->value) {?><?php echo $_smarty_tpl->tpl_vars['data']->value['token'];?>
<?php }?>", data).done(function(data) {
					if(data.ref) {
						alert("Modèle sauvegardé !");
					}
				}).fail(function() {
					alert('Oups ! Il y a eu une erreur lors de la sauvegarde.');
				});
			}, 0);

			return false;
		});
		
	})();
	

</script>
<?php if ($_smarty_tpl->tpl_vars['data']->value&&$_smarty_tpl->tpl_vars['data']->value['token']) {?>
<script>

	(function() {
		
		$.get('<?php echo $_smarty_tpl->tpl_vars['baseUri']->value;?>
/?/api/template/token/<?php echo $_smarty_tpl->tpl_vars['data']->value['token'];?>
', function(data) {
			
			var $form = $('#form');
			
			$form.find('#form-id').val(data.id);
			$form.find('#form-shortTitle').val(data.shortTitle);
			$form.find('#form-catchPhrase').val(data.catchPhrase);
			$form.find('#form-text').val(data.text);
			
			initMCE();
			
		});
		
	})();
	
</script>
<?php } else { ?>
<script>

	initMCE();

</script>
<?php }?><?php }} ?>
