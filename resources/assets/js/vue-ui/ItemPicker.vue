<template>
<div class="item-picker" v-on-click-outside="hideDropDown">
    <input 
        type="text" 
        id="placeholder"
        value=""
        class="form-control" 
        v-model="placeholder"
        v-on:click="showDropDown"
         />
    <input type="hidden" 
        v-model="total"
        v-bind:name="elname"
        readonly
    />
    <div 
        v-for="(item, index) in items"
        v-bind:key="index">
            <input type="hidden" 
                v-model="items[index].val"
                v-bind:name="item.name" 
                readonly/>
    </div>
    
    <div 
        class="card p-3 item-picker-dropdown" 
        v-if="show"
        >
        <div 
            class="row mb-3"
            v-for="(item, index) in items"
            v-bind:key="index">
            <div class="col-md-6">{{ item.name }}</div>
            <div class="col-md-2">
                <button 
                    class="btn btn-sm btn-primary"
                    v-bind:disabled="item.isMin"
                    v-on:click="decrease($event, index)">-</button>
            </div>
            <div class="col-md-2">
                {{ item.val }}
            </div>
            <div class="col-md-2">
                <button 
                    class="btn btn-sm btn-primary"
                    v-bind:disabled="item.isMax"
                    v-on:click="increase($event, index)">+</button>
            </div>
        </div>
        
    </div>
</div>
</template>

<script>
import { directive as onClickOutside } from 'vue-on-click-outside';

export default {
    name: "ItemPicker",
    directives: { 
        'on-click-outside': onClickOutside
    },
    props: {
        max: {
            default: false,
            type: Number || Boolean
        },
        min: {
            default: 0,
            type: Number
        },
        elems: {
            default: function() {return []},
            type: Array
        },
        elname: {
            default: 'Items',
            type: String
        }
    },
    data: function(){
        return {
            show: false,
            items: [],
            total: 0,
            placeholder: ''
        }
    },
    mounted: function() {
        this.items = this.elems;
        this.compute();
        this.validate();
    },
    methods: {
        validate: function () {
            if( this.total > this.max ) {
                throw new Error('Computed total is greated than the max value');
            }
            if( this.total < this.min ) {
                throw new Error('Computed total is less than the min value')
            }
        },
        compute: function ( minMax = true ) {
            
            if( !this.elems.length ) {
                throw new Error('No Elements Defined');
            }

            this.total = this.items.reduce( (prev, next) => prev.val + next.val);
            this.placeholder = this.total + ' ' + this.elname;

            if( minMax ) {
                this.setMinMax();
            }
        },
        showDropDown: function() {
            this.show = true;
        },
        hideDropDown: function() {
            this.show = false;
        },
        decrease: function(event, index) {
            event.preventDefault();
            this.items[index].val--;
            this.compute();            
        },
        increase: function(event, index) {
            event.preventDefault();
            this.items[index].val++;
            this.compute();
        },
        setMinMax: function () {
            this.items.map( (item, i) => {
                item.isMin = this.total <= this.min ? true : item.val <= item.min;
                item.isMax = this.total >= this.max ? true : (item.max && item.val >= item.max )
                return item;
            });            
        }
    }
}
</script>

<style scoped>
.item-picker-dropdown{
    z-index: 50;
    position: absolute;
    width:400px;
}
#placeholder {
    cursor:pointer;
}
</style>