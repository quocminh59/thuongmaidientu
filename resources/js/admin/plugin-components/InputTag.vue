<template>
  <div class='tag-input'>
    <div v-for='(tag, index) in tags' :key='index' class='tag-input__tag'>
      <span @click="removeTag">x</span>
      {{ tag }}
    </div>
    <input 
      type='text' 
      placeholder="Space a Tag" 
      class='tag-input__text' 
      @keydown.space='addTag' 
    />
  </div>
</template>
<script>
export default {
  props: {
    directive: String,
    tagPassed: Array
  },
  data () {
    return {
      tags: []
    }
  },
  watch: {
    directive: function() {
        if(this.directive == 'stop') {
            this.tags = [];
        }
    },
    tagPassed: function() {
      if(this.tagPassed.length > 0) {
        this.tags = this.tagPassed;
      }
    }
  },
  methods: {
      addTag: function(event) {
          event.preventDefault();
          var val = event.target.value.trim();
          if(val.length > 0) {
              this.tags.push(val);
              this.passValue();
              event.target.value= '';
          }
      },
      removeTag: function(index) {
          this.tags.splice(index,1);
      },
      passValue: function() {
        this.$emit('passing', this.tags);
      }
}
      
}

</script>
<style scoped>
.tag-input {
  border: 1px solid #eee;
  font-size: 0.9em;
  height: auto;
  box-sizing: border-box;
  padding: 0 10px;
  display: flex;
  flex-wrap: wrap;
  align-items: center;
}

.tag-input__tag {
  margin-right: 10px;
  background-color: #eee;
  line-height: 30px;
  padding: 0 5px;
  border-radius: 5px;
}

.tag-input__tag > span {
  cursor: pointer;
  opacity: 0.75;
}

.tag-input__text {
  border: none;
  outline: none;
  font-size: 0.9em;
  line-height: 50px;
  background: none;
  width: 15rem;
}
</style>