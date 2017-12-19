<template>
  <div id="dp">
        <datepicker v-model="bd" language="ru" @selected="changeData"></datepicker>
  </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker'

export default
{
  name: 'dp',
  components: {Datepicker},
  props:['ddate'],
  data (){
  		return { bd: this.ddate};
  	},
  methods:{
  	changeData: function (newdate)
  	{
  		this.$emit('changedate', newdate.toLocaleFormat('%Y-%m-%d'))		
  	}
  }
}
</script>