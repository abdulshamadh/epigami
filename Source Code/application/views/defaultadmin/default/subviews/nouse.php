<div class="ecommfildiv"> 
              <!----- ----->

              <div class="accordion" id="accordion21">
                <?php foreach($ecomm as $ecomVal) { $ecomCredential = json_decode($ecomVal['credentials'], true);?>
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion21" href="#<?=$ecomVal['method_id']?>">
                    <?=$ecomVal['name']?>
                    </a> </div>
                  <div id="<?=$ecomVal['method_id']?>" class="accordion-body collapse">
                    <div class="accordion-inner">
                      <div class ="control-group">
                        <div class ="controls">
                          <div class ="input-prepend">
                            <input type ="hidden" value="<?php echo base_url();?>" class="btn" id="baseurl" name="baseurl"/>
                          </div>
                        </div>
                        <div class ="controls">
                          <div class ="input-prepend">
                            <input type ="submit" value="Update <?=$ecomVal['name']?> Payment Gateway" class="btn" onclick="return getPaymentGatewayDetails(<?=$ecomVal['method_id']?>)" />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php } ?>
              </div>
              <!----- -----> 
            </div>