<div class="modal fade" id="statusExhib" tabindex="-1" aria-labelledby="createExcurs" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Изменить статус</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('exhib.changeStatus', ['id' => $exhibition->id]) }}" method="GET">
            <select name="status" class="form-select" aria-label="Default select example">
                <option selected>Выберите статус</option>
                @foreach ($status as $val)
                <option value="{{ $val->id }}">{{ $val->name }}</option>
                @endforeach
            </select>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                <button type="submit" class="btn btn-primary">Изменить</button>
              </div>
          </form>
        </div>

      </div>
    </div>
  </div>
