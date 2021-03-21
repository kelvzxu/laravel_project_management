<table border="0" cellpadding="0" cellspacing="0" style="padding-top: 16px; background-color: #F1F1F1; font-family:Verdana, Arial,sans-serif; color: #454748; width: 100%; border-collapse:separate;"><tr><td align="center">
<table border="0" cellpadding="0" cellspacing="0" width="650" style="padding: 16px; background-color: white; color: #454748; border-collapse:separate;">
<tbody>
    <!-- HEADER --><tr>
        <td align="center" style="min-width: 650px;">
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
    <tr>
    <td>
        <div>
            <p style="font-size: 12px;">
                Hello, {{ $data->name }}
                <br/><br/>
                The tasks given to you have not been completed, 
                the following is a list of tasks that are still waiting to be completed
                <br/><br/>
                    <table width="100%" style="color: #454748; font-size: 12px; border-collapse: collapse;">
                        <tr style="border-bottom: 2px solid #dee2e6;">
                            <td width="50%"><strong>Task name</strong></td>
                            <td width="30%"><strong>Project</strong></td>
                            <td><strong>deadline</strong></td>
                        </tr>
                            @foreach($data->tasks as $task)
                                <tr>
                                    <td width="50%"><strong>{{ $task->name }}</strong></td>
                                    <td width="30%"><strong>{{ $task->project->name}}</strong></td>
                                    <td><strong>{{ $task->date_end}}</strong></td>
                                </tr>
                            @endforeach
                    </table>
                <br/><br/>
                Do periodic reporting of the work of the task to your project manager
                <br/>
            </p>
        </div>
    </td>
    </tr>
</tbody>
</table>
</td></tr>
<!-- POWERED BY -->
<tr><td align="center" style="min-width: 590px;">
    <table border="0" cellpadding="0" cellspacing="0" width="650" style="min-width: 650px; background-color: #F1F1F1; color: #454748; padding: 8px; border-collapse:separate;">
      <tr><td style="text-align: center; font-size: 13px;">
        Powered by <a target="_blank" href="https://kltech-intl.odoo.com" style="color: #875A7B;">Kelvzxu</a>
      </td></tr>
    </table>
</td></tr>
</table>