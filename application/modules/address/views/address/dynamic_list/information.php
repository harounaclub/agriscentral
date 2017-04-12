<div class="row">

    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="panel panel-darken">

            <div class="panel-heading">
                <h3 class="panel-title">Address</h3>
            </div>
            <div class="panel-body no-padding text-align-center">
                
                <table class="table">
                    <tbody>
                        <tr>
                            <td>
                                Address : <?php echo $ADDRESS->address; ?>
                            </td>
                        </tr>
                        <tr class="active">
                            <td>
                                Location : <?php echo $ADDRESS->location; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                City : <?php echo $ADDRESS->city; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Serial Number : <?php echo (isset($ADDRESS->serial_number) && $ADDRESS->serial_number !='' ? $ADDRESS->serial_number : ''); ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
    

</div>

<!--
<div class="well">
                                        
    <div class="row show-grid">
        <div class="col-md-12">
            Address : <?php echo $ADDRESS->address; ?>
            <div class="row show-grid">
                <div class="col-md-6">
                    Location: <?php echo $ADDRESS->location; ?>
                </div>
                
            </div>
            
            <div class="row show-grid">
                <div class="col-md-6">
                    City: <?php echo $ADDRESS->city; ?>
                </div>
            </div>
        </div>
    </div>

</div>
-->