   <!-- QR & Bank Info -->
   <!--     <div class="col-lg-6">-->
   <!--       <div class="p-4 border rounded shadow-sm bg-white">-->
   <!--         <h4 class="text-center mb-3">Scan & Donate via QR</h4>-->
   <!--         <div class="d-flex justify-content-center mb-4">-->
   <!--           <img src="https://hexdocs.pm/qr_code/docs/qrcode.svg" alt="QR Code" style="width:200px;" />-->
   <!--         </div>-->

   <!--         <h4 class="text-center mb-3 mt-4">Bank Details</h4>-->
   <!--         <div class="table-responsive">-->
   <!--           <table class="table table-bordered">-->
   <!--             <tbody>-->
   <!--               <tr>-->
   <!--                 <th style="width: 40%;">UPI ID</th>-->
   <!--                 <td>dummyupi@upi</td>-->
   <!--               </tr>-->
   <!--               <tr>-->
   <!--                 <th>Account Number</th>-->
   <!--                 <td>1234567890</td>-->
   <!--               </tr>-->
   <!--               <tr>-->
   <!--                 <th>Account Name</th>-->
   <!--                 <td>Mansha Welfare Society</td>-->
   <!--               </tr>-->
   <!--               <tr>-->
   <!--                 <th>IFSC Code</th>-->
   <!--                 <td>ABCDEF12345</td>-->
   <!--               </tr>-->
   <!--               <tr>-->
   <!--                 <th>Bank Name</th>-->
   <!--                 <td>State Bank of India</td>-->
   <!--               </tr>-->
   <!--               <tr>-->
   <!--                 <th>Bank Branch</th>-->
   <!--                 <td>Shamshad Market, Aligarh</td>-->
   <!--               </tr>-->
   <!--             </tbody>-->
   <!--           </table>-->
   <!--         </div>-->

   <!--         <p class="text-muted mt-3" style="font-weight: 500;">-->
   <!--           <strong>Note:</strong> After payment, please share the payment screenshot via WhatsApp:-->
   <!--           <a href="https://wa.me/919897834777" target="_blank">+91 98978 34777</a>-->
   <!--           or email your details to: <a href="mailto:formjs@gmail.com">formjs@gmail.com</a>-->
   <!--         </p>-->
   <!--       </div>-->
   <!--     </div>-->
   
   <!-- QR & Bank Info -->
<div class="col-lg-6">
  <div class="p-4 border rounded shadow-sm bg-white">
    <h4 class="text-center mb-3">Scan & Donate via QR</h4>
    <div class="d-flex justify-content-center mb-4">
      @if(!empty($donationSetting->qr_code_url))
        <img src="{{ asset('public/'.$donationSetting->qr_code_url) }}" 
             alt="QR Code" 
             style="width:200px;" />
      @else
        <p class="text-muted">QR code not available</p>
      @endif
    </div>

    <h4 class="text-center mb-3 mt-4">Bank Details</h4>
    <div class="table-responsive">
      <table class="table table-bordered">
        <tbody>
          @if(!empty($donationSetting->upi_id))
          <tr>
            <th style="width: 40%;">UPI ID</th>
            <td>{{ $donationSetting->upi_id }}</td>
          </tr>
          @endif

          @if(!empty($donationSetting->account_number))
          <tr>
            <th>Account Number</th>
            <td>{{ $donationSetting->account_number }}</td>
          </tr>
          @endif

          @if(!empty($donationSetting->account_name))
          <tr>
            <th>Account Name</th>
            <td>{{ $donationSetting->account_name }}</td>
          </tr>
          @endif

          @if(!empty($donationSetting->ifsc_code))
          <tr>
            <th>IFSC Code</th>
            <td>{{ $donationSetting->ifsc_code }}</td>
          </tr>
          @endif

          @if(!empty($donationSetting->bank_name))
          <tr>
            <th>Bank Name</th>
            <td>{{ $donationSetting->bank_name }}</td>
          </tr>
          @endif

          @if(!empty($donationSetting->bank_branch))
          <tr>
            <th>Bank Branch</th>
            <td>{{ $donationSetting->bank_branch }}</td>
          </tr>
          @endif
        </tbody>
      </table>
    </div>

    @if(!empty($donationSetting->whatsapp_number) || !empty($donationSetting->email))
    <p class="text-muted mt-3" style="font-weight: 500;">
      <strong>Note:</strong> After payment, please share the payment screenshot via WhatsApp:
      @if(!empty($donationSetting->whatsapp_number))
        <a href="https://wa.me/{{ preg_replace('/\D/', '', $donationSetting->whatsapp_number) }}" target="_blank">
          {{ $donationSetting->whatsapp_number }}
        </a>
      @endif
      @if(!empty($donationSetting->email))
        or email your details to: 
        <a href="mailto:{{ $donationSetting->email }}">{{ $donationSetting->email }}</a>
      @endif
    </p>
    @endif
  </div>
</div>

