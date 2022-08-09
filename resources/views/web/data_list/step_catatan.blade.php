<div id="catatan" class="content dstepper-block" role="tabpanel" aria-labelledby="catatan-trigger">
    <h3>{{__('step_other_notes.title')}}</h3>
    <div class="row">
        <div class="mb-1 col-md-12">
            <label class="form-label" for="note_applied_another_branch">{{__('step_other_notes.label.pernah_daftar')}}</label>
            <textarea readonly name="note_applied_another_branch" id="note_applied_another_branch" class="square form-control">{{$old->note_applied_another_branch}}</textarea>
        </div>
    </div>
</div>
