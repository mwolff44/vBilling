<?php 
/*
 * Version: MPL 1.1
 *
 * The contents of this file are subject to the Mozilla Public License
 * Version 1.1 (the "License"); you may not use this file except in
 * compliance with the License. You may obtain a copy of the License at
 * http://www.mozilla.org/MPL/
 * 
 * Software distributed under the License is distributed on an "AS IS"
 * basis, WITHOUT WARRANTY OF ANY KIND, either express or implied. See the
 * License for the specific language governing rights and limitations
 * under the License.
 * 
 * The Original Code is "vBilling - VoIP Billing and Routing Platform"
 * 
 * The Initial Developer of the Original Code is 
 * Digital Linx [<] info at digitallinx.com [>]
 * Portions created by Initial Developer (Digital Linx) are Copyright (C) 2011
 * Initial Developer (Digital Linx). All Rights Reserved.
 *
 * Contributor(s)
 * "Digital Linx - <vbilling at digitallinx.com>"
 *
 * vBilling - VoIP Billing and Routing Platform
 * version 0.1.3
 *
 */
?>
<script type="text/javascript">
if(!window.opener){
window.location = '../../home/';
}
</script>
<table cellspacing="0" cellpadding="0" border="0" align="center" width="100%">
	<tbody><tr>
            <td width="21" height="35"></td>
            <td width="825" class="heading">
            New ACL Node            </td>
            <td width="178">
            <table cellspacing="0" cellpadding="0" width="170" height="42" class="search_col">
                <tbody><tr>
                    <td align="center" width="53" valign="bottom">&nbsp;</td>
                </tr>
                
                <tr>
                    <td align="center" width="53" valign="top">&nbsp;</td>
                </tr>
            </tbody></table>
            </td>
        </tr>
        <tr>
        <td background="<?php echo base_url();?>assets/images/line.png" height="7" colspan="3"></td>
        </tr>
        
        <?php require_once("pop_up_menu.php");?>

                <tr>
            <td height="10"></td>
            <td></td>
            <td></td>
        </tr>
        
        <tr>
        <td colspan="3"><div class="error" id="err_div" style="display:none;"></div></td>
        </tr>
        
        <tr>
        <td colspan="3"><div class="success" id="success_div" style="display:none;"></div></td>
        </tr>
              
<tr>
    <td align="center" height="20" colspan="3">
        <form enctype="multipart/form-data"  method="post" action="" name="addAclNode" id="addAclNode">
            <table cellspacing="3" cellpadding="2" border="0" width="95%" class="search_col">
                
                <input type="hidden" name="customer_id" id="customer_id" value="<?php echo $customer_id;?>"/>
                
                <tbody>
                
                <tr>
                    <td align="right" width="45%"><span class="required">*</span> IP Address:</td>
                    <td align="left" onmouseover="return overlib('<?php echo $this->lang->line('admin_new_acl_node_view_acl_node');?>', HAUTO, VAUTO, STICKY)" onmouseout="return nd()" width="55%"><input name="ip" type="text" class="textfield numeric" id="ip" maxlength="15"></td>
                </tr>
                <tr>
<!--
                    <td align="right"><span class="required">*</span> CIDR:</td>
                    <td align="left">
                        <select  name="cidr" id="cidr" class="textfield">
                            <?php 
                            for($i=0; $i<=32; $i++){
                                if($i == 32)
                                {
                                    echo '<option value="'.$i.'" selected>'.$i.'</option>';
                                }
                                else
                                {
                                    echo '<option value="'.$i.'" selected>'.$i.'</option>';
                                }
                            }
                            ?>
                               
                        </select>
                    </td>
-->
                </tr>
                
                <tr>
                    <td align="right" colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td align="center" colspan="2"><input border="0" id="submitaddAclNodeForm" type="image" src="<?php echo base_url();?>assets/images/btn-submit.png"></td>
                    
                    
                </tr>
            </tbody></table>
        </form>
    </td>
</tr>

<tr>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
</tr>

<tr>
    <td height="5"></td>
    <td></td>
    <td></td>
</tr>


<tr>
    <td height="20" colspan="3">&nbsp;</td>
</tr>
    <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
    </tbody></table>

<script type="text/javascript">
    
    
    $('#addAclNode').submit(function(){
        //show wait msg 
    $.blockUI({ css: { 
                    border: 'none', 
                    padding: '15px', 
                    backgroundColor: '#000', 
                    '-webkit-border-radius': '10px', 
                    '-moz-border-radius': '10px', 
                    opacity: .5, 
                    color: '#fff' 
                    } 
                });
                
        var ip = $('#ip').val();
<!--
        var cidr = $('#cidr').val();
-->
		var cidr = "32"
        var pattern = /^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/;
        
        var required_error = 0;
        var ip_error = 0;
        
        //common required fields check
        if(ip == '' || cidr == '')
        {
            required_error = 1;
        }
        
        if(ip != '')
        {
            if(!pattern.test(ip))
            {
                ip_error = 1;
            }
        }
        
        var text = "";
        
        if(required_error == 1)
        {
            text += "Fields With * Are Required Fields<br/>";
        }
        
        if(ip_error == 1)
        {
            text += "Invalid IP Address<br/>";
        }
        
        if(text != '')
        {
            $('.success').hide();
            $('.error').html(text);
            $('.error').fadeOut();
            $('.error').fadeIn();
            document.getElementById('err_div').scrollIntoView();
            $.unblockUI();
            return false;
        }
        else
        {
           var form = $('#addAclNode').serialize();
            $.ajax({
                    type: "POST",
					url: base_url+"customers/insert_new_acl_node",
					data: form,
                    success: function(html){
                        $('.error').hide();
                        $('.success').html("Customer ACL Node Added Successfully.");
                        $('.success').fadeOut();
                        $('.success').fadeIn();
                        document.getElementById('success_div').scrollIntoView();
                        $.unblockUI();
                    }
				});
                
            return false;
        }
        return false;
    });
    
    $('.numeric').numeric({allow:"."});
</script>