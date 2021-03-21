<table border="0" cellpadding="0" cellspacing="0" style="padding-top: 16px; background-color: #F1F1F1; font-family:Verdana, Arial,sans-serif; color: #454748; width: 100%; border-collapse:separate;"><tr><td align="center">
<table border="0" cellpadding="0" cellspacing="0" width="590" style="padding: 16px; background-color: white; color: #454748; border-collapse:separate;">
<tbody>
    <!-- HEADER -->
    <tr>
        <td align="center" style="min-width: 590px;">
            <table border="0" cellpadding="0" cellspacing="0" width="590" style="min-width: 590px; background-color: white; padding: 0px 8px 0px 8px; border-collapse:separate;">
                <tr><td valign="middle">
                    <span style="font-size: 10px;">Welcome to Laravel Project Management</span><br/>
                    <span style="font-size: 20px; font-weight: bold;">
                        {{ $data->name }}
                    </span>
                </td><td valign="middle" align="right">
                    <img src="https://icons.getbootstrap.com/assets/img/icons-hero.png" style="padding: 0px; margin: 0px; height: auto; width: 80px;" alt="${object.company_id.name}"/>
                </td></tr>
                <tr><td colspan="2" style="text-align:center;">
                  <hr width="100%" style="background-color:rgb(204,204,204);border:medium none;clear:both;display:block;font-size:0px;min-height:1px;line-height:0; margin: 16px 0px 16px 0px;"/>
                </td></tr>
            </table>
        </td>
    </tr>
    <!-- CONTENT -->
    <tr>
        <td align="center" style="min-width: 590px;">
            <table border="0" cellpadding="0" cellspacing="0" width="590" style="min-width: 590px; background-color: white; padding: 0px 8px 0px 8px; border-collapse:separate;">
                <tr><td valign="top" style="font-size: 13px;">
                    <div>
                        Dear {{ $data->name}},<br /><br />
                        Congratulation, Your request to join {{ $data->team ?? ''}} has been Approved.
                        <div style="margin: 16px 0px 16px 0px;">
                            <a href="{{asset('/dashboard')}}"
                                style="background-color: #7952B3; padding: 8px 16px 8px 16px; text-decoration: none; color: #fff; border-radius: 5px; font-size:13px;">
                                Start Contribute
                            </a>
                        </div>
                        <br /><br />
                        Never heard of {{ config('app.name')}}? It’s an Project Management software loved by 3+ million users. It will considerably improve your experience and increase your productivity.
                        <br /><br />
                        Enjoy {{config('app.name')}}!<br />
                        --<br/>The administrator Team
                    </div>
                </td></tr>
                <tr><td style="text-align:center;">
                  <hr width="100%" style="background-color:rgb(204,204,204);border:medium none;clear:both;display:block;font-size:0px;min-height:1px;line-height:0; margin: 16px 0px 16px 0px;"/>
                </td></tr>
            </table>
        </td>
    </tr>
    <!-- FOOTER -->
    <tr>
        <td align="center" style="min-width: 590px;">
            <table border="0" cellpadding="0" cellspacing="0" width="590" style="min-width: 590px; background-color: white; font-size: 11px; padding: 0px 8px 0px 8px; border-collapse:separate;">
                <tr><td valign="middle" align="left">
                    {{ config('app.name')}}
                </td></tr>
                <tr><td valign="middle" align="left" style="opacity: 0.7;">
                        | no-reply@kltech-intl.technology
                        | <a href="https://kltech-intl.odoo.com" style="text-decoration:none; color: #454748;">kltech-intl.odoo.com</a>
                </td></tr>
            </table>
        </td>
    </tr>
</tbody>
</table>
</td></tr>
<!-- POWERED BY -->
<tr><td align="center" style="min-width: 590px;">
    <table border="0" cellpadding="0" cellspacing="0" width="590" style="min-width: 590px; background-color: #F1F1F1; color: #454748; padding: 8px; border-collapse:separate;">
      <tr><td style="text-align: center; font-size: 13px;">
        Powered by <a target="_blank" href="https://kltech-intl.odoo.com" style="color: #875A7B;">Kelvzxu</a>
      </td></tr>
    </table>
</td></tr>
</table>