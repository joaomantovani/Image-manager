<!-- field_type_name -->
<div @include('crud::inc.field_wrapper_attributes') >
    <label>{!! $field['label'] !!}</label>

    <!-- Fine Uploader DOM Element
    ====================================================================== -->
    <div id="fine-uploader-gallery"></div>
    <input type="hidden" name="images">

    <!-- Your code to create an instance of Fine Uploader and bind to the DOM/template
    ====================================================================== -->
    <script>

    function getProjectID() {
    	return window.location.pathname.split("/")[3];
    }

        var galleryUploader = new qq.FineUploader({
            element: document.getElementById("fine-uploader-gallery"),
            template: 'qq-template-gallery',
            request: {
                endpoint: '/admin/server/upload/' + getProjectID() + '/save',
            },
            deleteFile: {
                enabled: true,
                endpoint: '/admin/server/upload/delete',
            },
            session: {
            	endpoint: '/admin/server/upload/recover/' + getProjectID(),
           	},
           	editFilename: {
       	        enabled: true
       	    },
            // thumbnails: {
            //     placeholders: {
            //         waitingPath: '/source/placeholders/waiting-generic.png',
            //         notAvailablePath: '/source/placeholders/not_available-generic.png'
            //     }
            // },
            validation: {
                allowedExtensions: ['jpeg', 'jpg', 'gif', 'png']
            },
        });

        $.post('url', data, function(response) {
        	console.clear();
        	console.log('vai coimeça birl');
            console.log(response);
        });
    </script>

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
</div>


@if ($crud->checkIfFieldIsFirstOfItsType($field, $fields))
  {{-- FIELD EXTRA CSS  --}}
  {{-- push things in the after_styles section --}}

      @push('crud_fields_styles')

      	<script
      	  src="https://code.jquery.com/jquery-3.1.1.min.js"
      	  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
      	  crossorigin="anonymous"></script>

		<!-- Fine Uploader Gallery CSS file
		====================================================================== -->
		<link href="{{ asset('css/fine-uploader-gallery.min.css') }}" rel="stylesheet">

		<!-- Fine Uploader JS file
		====================================================================== -->
		<script src="{{ asset('js/fine-uploader.js') }}"></script>

		<script type="text/template" id="qq-template-gallery">
		    <div class="qq-uploader-selector qq-uploader qq-gallery" qq-drop-area-text="Arraste os arquivos aqui">
		        <div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">
		            <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>
		        </div>
		        <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
		            <span class="qq-upload-drop-area-text-selector"></span>
		        </div>
		        <div class="qq-upload-button-selector qq-upload-button">
		            <div>Carregar</div>
		        </div>
		        <span class="qq-drop-processing-selector qq-drop-processing">
		            <span>fazendo o upload das imagens...</span>
		            <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
		        </span>
		        <ul class="qq-upload-list-selector qq-upload-list" role="region" aria-live="polite" aria-relevant="additions removals">
		            <li>
		                <span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>
		                <div class="qq-progress-bar-container-selector qq-progress-bar-container">
		                    <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-progress-bar-selector qq-progress-bar"></div>
		                </div>
		                <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
		                <div class="qq-thumbnail-wrapper">
		                    <img class="qq-thumbnail-selector" qq-max-size="120" qq-server-scale>
		                </div>
		                <button type="button" class="qq-upload-cancel-selector qq-upload-cancel">X</button>
		                <button type="button" class="qq-upload-retry-selector qq-upload-retry">
		                    <span class="qq-btn qq-retry-icon" aria-label="Retry"></span>
		                    Tentar denovo
		                </button>

		                <div class="qq-file-info">
		                    <div class="qq-file-name">
		                        <span class="qq-upload-file-selector qq-upload-file"></span>
		                        <span class="qq-edit-filename-icon-selector qq-edit-filename-icon" aria-label="Edit filename"></span>
		                    </div>
		                    <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">
		                    <span class="qq-upload-size-selector qq-upload-size"></span>
		                    <button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete">
		                        <span class="qq-btn qq-delete-icon" aria-label="Delete"></span>
		                    </button>
		                    <button type="button" class="qq-btn qq-upload-pause-selector qq-upload-pause">
		                        <span class="qq-btn qq-pause-icon" aria-label="Pause"></span>
		                    </button>
		                    <button type="button" class="qq-btn qq-upload-continue-selector qq-upload-continue">
		                        <span class="qq-btn qq-continue-icon" aria-label="Continue"></span>
		                    </button>
		                </div>
		            </li>
		        </ul>

		        <dialog class="qq-alert-dialog-selector">
		            <div class="qq-dialog-message-selector"></div>
		            <div class="qq-dialog-buttons">
		                <button type="button" class="qq-cancel-button-selector">Fechar</button>
		            </div>
		        </dialog>

		        <dialog class="qq-confirm-dialog-selector">
		            <div class="qq-dialog-message-selector"></div>
		            <div class="qq-dialog-buttons">
		                <button type="button" class="qq-cancel-button-selector">Não</button>
		                <button type="button" class="qq-ok-button-selector">Sim</button>
		            </div>
		        </dialog>

		        <dialog class="qq-prompt-dialog-selector">
		            <div class="qq-dialog-message-selector"></div>
		            <input type="text">
		            <div class="qq-dialog-buttons">
		                <button type="button" class="qq-cancel-button-selector">Cancelar</button>
		                <button type="button" class="qq-ok-button-selector">Ok</button>
		            </div>
		        </dialog>
		    </div>
		</script>

      @endpush


  {{-- FIELD EXTRA JS --}}
  {{-- push things in the after_scripts section --}}

      @push('crud_fields_scripts')

      @endpush
@endif

{{-- Note: most of the times you'll want to use @if ($crud->checkIfFieldIsFirstOfItsType($field, $fields)) to only load CSS/JS once, even though there are multiple instances of it. --}}