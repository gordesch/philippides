<div class="form-group">
    <label for="section_id">Section</label>
    <select name="section_id" class="form-control">
        @if(session('user')->role->scope === 'section')
            <option value="{{ session('user')->person->section->id }}" selected>{{ session('user')->person->section->name }}</option>
        @else
            @foreach(\App\Section::all() as $section)
                <option
                    value="{{ $section->id }}"
                    @if(session('section')->id === $section->id)
                        selected
                    @endif
                >
                    {{ $section->name }}
                </option>
            @endforeach
        @endif
    </select>
</div>