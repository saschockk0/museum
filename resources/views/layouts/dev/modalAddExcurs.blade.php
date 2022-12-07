<div class="modal fade" id="createExcurs" tabindex="-1" aria-labelledby="createExcurs" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Добавить экскурсию</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('admin.createExcurs') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="mb-3">
              <label for="title" class="col-form-label">Заголовок</label>
              <input type="text" class="form-control" name="title" id="title">
            </div>
            <div class="mb-3">
              <label for="description" class="col-form-label">Описание</label>
              <textarea class="form-control" id="description" name="description" style="max-height: 100px"></textarea>
            </div>
            <div class="mb-3">
                <label for="date_start" class="col-form-label">Начало мероприятия</label>
                <input type="datetime-local" class="form-control" name="date_start" id="date_start">
            </div>
            <div class="mb-3">
                <label for="date_end" class="col-form-label">Окончание мероприятия</label>
                <input type="datetime-local" class="form-control" name="date_end" id="date_end">
            </div>
            <div class="mb-3">
                <label for="file" class="col-form-label">Фотография</label>
                <input type="file" class="form-control" name="file" id="file">
            </div>
            <div class="mb-3">
                <label for="places" class="col-form-label">Мест</label>
                <input type="number" min="5" max="30" class="form-control" name="places" id="places">
            </div>
            <div class="mb-3">
                <label for="price" class="col-form-label">Цена за билет</label>
                <input type="number" class="form-control" name="price" id="price">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                <button type="submit" class="btn btn-primary">Добавить</button>
              </div>
          </form>
        </div>

      </div>
    </div>
  </div>
