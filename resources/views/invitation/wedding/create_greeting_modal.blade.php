<div class="modal fade" id="modalGreeting" tabindex="-1" role="dialog" aria-labelledby="modalGreetingLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modalGreetingLabel">Ucapkan sesuatu untuk Kedua Mempelai</h4>
	  	  <button type="button" class="close btn btn-secondary" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  	  <form id="form-store-greeting" action="{{route('invitation.guest.store_greeting',[$template_category->name,$template_user->user_url])}}" method="POST">
          @csrf
          @method('post')
			    <input type="hidden" name="name" value="{{$guest_name}}">
          <div class="form-group">
            <textarea class="form-control" name="greeting" rows="6" placeholder="Tulis ucapan Kamu di sini...">{{old('greeting')}}</textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
	  	  <button type="button" id="btnSaveGreeting" class="btn btn-primary">Kirim</button>
      </div>
    </div>
  </div>
</div>