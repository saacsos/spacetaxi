<template>
    <div class="form-input">
        <input type="text" :name="name" autocomplete="off" :value="value" required />
        <label :for="name" class="label-name">
            <span class="content-name">{{ label }}</span>
            <span class="content-name invalid" v-if="error.length > 0">{{ error }}</span>
        </label>

    </div>
</template>

<script>
export default {
    props: [
        'name', 'label', 'value', 'error'
    ]
}
</script>

<style>
.form-input {
    width: 100%;
    position: relative;
    height: 53px;
    overflow: hidden;
}

.form-input input {
    width: 100%;
    height: 100%;
    color: #595f6e;
    padding-top: 18px;
    border: none;
    outline: none;
}

.form-input label {
    position: absolute;
    bottom: 0px;
    left: 0%;
    width: 100%;
    height: 100%;
    pointer-events: none;
    border-bottom: 1px solid black;
}

.form-input label::after {
    content: "";
    position: absolute;
    left: 0px;
    bottom: -1px;
    width: 100%;
    height: 100%;
    border-bottom: 3px solid #5fa8d3;
    transform: translateX(-100%);
    transition: transform 0.3s ease;
}

.content-name {
    position: absolute;
    bottom: 5px;
    left: 0px;
    transition: all 0.3s ease;
}

.form-input input:valid + .label-name .content-name.invalid {
    left: 10%;
    color: #f66d9b;
}

.form-input input:focus + .label-name .content-name,
.form-input input:valid + .label-name .content-name {
    transform: translateY(-100%);
    font-size: 14px;
    color: #5fa8d3;
}

.form-input input:focus + .label-name::after,
.form-input input:valid + .label-name::after {
    transform: translateX(0%);
}
</style>
