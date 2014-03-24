<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/feed.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
    </div>
  <div class="content">
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
      <table class="form">
        <tr>
          <td><?php echo $entry_status; ?></td>
          <td><select name="salesautopilot_status">
              <?php if ($salesautopilot_status) { ?>
              <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
              <option value="0"><?php echo $text_disabled; ?></option>
              <?php } else { ?>
              <option value="1"><?php echo $text_enabled; ?></option>
              <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
              <?php } ?>
            </select></td>
        </tr>
        <tr>
          <td><?php echo $entry_salesautopilot_username; ?></td>
          <td><input type="text" name="salesautopilot_username" value="<?php echo $salesautopilot_username; ?>" /></td>
        </tr>
		<tr>
          <td><?php echo $entry_salesautopilot_password; ?></td>
          <td><input type="text" name="salesautopilot_password" value="<?php echo $salesautopilot_password; ?>" /></td>
        </tr>
		<tr>
          <td><?php echo $entry_salesautopilot_listid; ?></td>
          <td><input type="text" name="salesautopilot_listid" value="<?php echo $salesautopilot_listid; ?>" /></td>
        </tr>
		<tr>
          <td><?php echo $entry_salesautopilot_formid; ?></td>
          <td><input type="text" name="salesautopilot_formid" value="<?php echo $salesautopilot_formid; ?>" /></td>
        </tr>
        <tr>
          <td><?php echo $entry_debug; ?></td>
          <td><select name="salesautopilot_debug">
              <?php if ($salesautopilot_debug) { ?>
              <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
              <option value="0"><?php echo $text_disabled; ?></option>
              <?php } else { ?>
              <option value="1"><?php echo $text_enabled; ?></option>
              <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
              <?php } ?>
            </select></td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php echo $footer; ?>