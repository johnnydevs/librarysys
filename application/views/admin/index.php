
<?php $this->renderFeedbackMessages(); ?>



<div class="container">
    
    <h1>AdminArea</h1>
            
    <div class="row">
        <div class="col-xs-6 col-md-3">
            
            <div class="panel status panel-danger">
                <div class="panel-heading text-center">
                    <i class="fa fa-4x fa-exclamation"></i>
                </div>
                <div class="panel-heading">
                    <h1 class="panel-title text-center">25</h1>
                </div>
                <div class="panel-body text-center">                        
                    <strong><a data-toggle="tooltip" data-placement="right" title="books currently on loan" href="<?php echo URL; ?>admin/onLoan">Overdue</a></strong>
                </div>
            </div>

        </div>          
        <div class="col-xs-6 col-md-3">
          
            <div class="panel status panel-warning">
                <div class="panel-heading text-center">
                    <i class="fa fa-4x fa-exchange"></i>
                </div>
                <div class="panel-heading">
                    <h1 class="panel-title text-center">25</h1>
                </div>
                <div class="panel-body text-center">                        
                    <strong><a data-toggle="tooltip" data-placement="right" title="books currently on loan" href="<?php echo URL; ?>admin/onLoan">On Loan</a></strong>
                </div>
            </div>

        </div>
        <div class="col-xs-6 col-md-3">
           
            <div class="panel status panel-success">
                <div class="panel-heading text-center">
                    <i class="fa fa-4x fa-archive"></i>
                </div>
                <div class="panel-heading">
                    <h1 class="panel-title text-center">25</h1>
                </div>
                <div class="panel-body text-center">                        
                    <strong><a data-toggle="tooltip" data-placement="right" title="books currently archived" href="<?php echo URL; ?>admin/archive">Archived</a></strong>
                </div>
            </div>

         
        </div>
        <div class="col-xs-6 col-md-3">
          
            <div class="panel status panel-info">
                <div class="panel-heading text-center">
                    <i class="fa fa-4x fa-check-square-o"></i>
                </div>
                <div class="panel-heading">
                    <h1 class="panel-title text-center">25</h1>
                </div>
                <div class="panel-body text-center">                        
                    <strong><a data-toggle="tooltip" data-placement="right" title="books currently available" href="<?php echo URL; ?>admin/availableBooks">Available</a></strong>
                </div>
            </div>

         
        </div>
    </div>

</div>
