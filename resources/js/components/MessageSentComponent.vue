<template>
	<div class="row sent justify-content-end ">
		<div class="col-auto float-right text-right rounded">
			{{ content }}
		</div>
	</div>
</template>

<script>
	export default {
		props: {
			content: String
		},
		mounted() {
			console.log('Sent Message Component mounted.')
		}
	}
</script>