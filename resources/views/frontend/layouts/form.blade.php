<div class="chat-icon">
    <button type="button" class="chat-toggler"><i class="fa fa-comment"></i>Contact Mansha Education</button>
</div>

<!--Chat Popup-->
<div id="chat-popup" class="chat-popup">
    <div class="popup-inner">
        <div class="close-chat"><i class="fa fa-times"></i></div>
        <div class="chat-form">
            <p>Please fill out the form below and we will get back to you as soon as possible.</p>

            {{-- Success / Error Message --}}
            <div id="form-message" style="margin-bottom: 10px;"></div>

            <form id="chatForm" class="contact-form-validated">
                @csrf
                <div class="form-group">
                    <input type="text" name="name" placeholder="Your Name" required>
                </div>
                <div class="form-group">
                    <input type="text" name="name" placeholder="Mobile Number" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" placeholder="Your Email" required>
                </div>
                <div class="form-group">
                    <textarea name="text" placeholder="Your Text" required></textarea>
                </div>
                <div class="form-group message-btn">
                    <button type="submit" class="thm-btn">
                        Submit Now
                        <span class="icon-arrow-right"></span>
                        <i></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- jQuery AJAX --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){

    $("#chatForm").on("submit", function(e){
        e.preventDefault(); // Form ka default submit stop karega

        let formData = $(this).serialize();

        $.ajax({
            url: "{{ route('frontend.formrequest.store') }}",
            type: "POST",
            data: formData,
            beforeSend: function(){
                $("#form-message").html("<span style='color:blue;'>Submitting...</span>");
            },
            success: function(response){
                $("#form-message").html("<span style='color:green;'>We will contact you soon!</span>");
                $("#chatForm")[0].reset(); // Form clear
            },
       error: function(xhr){
    console.log("AJAX Error response:", xhr.responseText);  // Debug ke liye console me error details dikhaye

    if(xhr.status === 422){ // Validation error
        let errors = xhr.responseJSON.errors;
        let errorHtml = "<ul style='color:red;'>";
        $.each(errors, function(key, value){
            errorHtml += "<li>" + value[0] + "</li>";
        });
        errorHtml += "</ul>";
        $("#form-message").html(errorHtml);
    } else {
        let message = "Something went wrong!";
        if(xhr.responseJSON && xhr.responseJSON.message){
            message = xhr.responseJSON.message;  // Laravel ka message agar available ho to use kare
        } else if(xhr.responseText){
            message = xhr.responseText;  // ya pura responseText dikhao
        }
        $("#form-message").html("<span style='color:red;'>" + message + "</span>");
    }
}

        });

    });

});
</script>
