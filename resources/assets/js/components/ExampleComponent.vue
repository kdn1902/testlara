<template>
<div>
                    <address>
 						 <strong>Twitter, Inc.</strong><br>
					 	 795 Folsom Ave, Suite 600<br>
 						 San Francisco, CA 94107<br>
  						 <abbr title="Phone">P:</abbr> (123) 456-7890
					</address>

					<address>
					  <strong>Full Name</strong><br>
					  <a href="mailto:#">first.last@example.com</a>
					</address>
					<button type="button" class="btn btn-default">Default</button>
					<button type="button" class="btn btn-primary">Primary</button>

					<!-- Indicates a successful or positive action -->
					<button type="button" class="btn btn-success">Success</button>

					<!-- Contextual button for informational alert messages -->
					<button type="button" class="btn btn-info">Info</button>

					<!-- Indicates caution should be taken with this action -->
					<button type="button" class="btn btn-warning">Warning</button>

					<!-- Indicates a dangerous or potentially negative action -->
					<button type="button" class="btn btn-danger">Danger</button>

					<!-- Deemphasize a button by making it look like a link while maintaining button behavior -->
					<button type="button" class="btn btn-link">Ссылка</button>
</div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
