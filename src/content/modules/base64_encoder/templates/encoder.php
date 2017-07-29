<form
	action="<?php echo ModuleHelper::buildAdminURL("base64_encoder");?>"
	method="post">
<?php csrf_token_html();?>
<p>
		<textarea cols="80" rows=7 name="input"><?php Template::escape(ViewBag::get("input"));?></textarea>
	</p>
	<ul class="list-unstyled">
		<li><input type="radio" name="mode" id="mode_encode" value="encode"
			<?php if(Request::getVar("mode", "encode") == "encode") echo "checked";?>>
			<label for="mode_encode"><?php translate("encode");?></label></li>
		<li><input type="radio" name="mode" id="mode_decode" value="decode"
			<?php if(Request::getVar("mode", "encode") == "decode") echo "checked";?>>
			<label for="mode_decode"><?php translate("decode");?></label></li>
	</ul>
<?php if(ViewBag::get("output")){?>
<h3><?php translate("result");?></h3>
	<p><?php Template::escape(ViewBag::get("output"));?></p>
<?php }?>
<input type="submit" value="<?php translate("ok");?>">
	</p>
</form>