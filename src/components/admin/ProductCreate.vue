<template>
    <div class="content pure-u-1 pure-u-md-21-24">
        <div class="header-small">

            <div class="items">
                <h1 class="subhead">Post Form</h1>

                <aside class="pure-message message-success">
                    <p><strong>SUCCESS</strong>: Success message.</p>
                </aside>
                <aside class="pure-message message-error">
                    <p><strong>ERROR</strong>: Error message.</p>
                </aside>
                <aside class="pure-message message-warning">
                    <p><strong>WARNING</strong>: Warning message.</p>
                </aside>
                <form action="#" method="post" novalidate autocomplete="off" class="pure-form pure-form-stacked">
                    <fieldset>
                        <label for="title">Title</label>
                        <input id="title" type="text" placeholder="Title" class="pure-input-1" value="">

                        <!--<label for="slug">Slug</label>
                        <input id="slug" type="text" placeholder="Slug" class="pure-input-1" value="" disabled>-->

                        <label for="excerpt">Price</label>
                        <input id="excerpt" type="number" placeholder="Price" class="pure-input-1" value="">

                        <label for="date">Quantity</label>
                        <input id="date" type="number" placeholder="quantity" class="pure-input-1" value="">

                        <label for="content">Description</label>
                        <textarea id="content" class="pure-input-1" rows="10"></textarea>

                        <label for="status">Status</label>
                        <select id="status" class="pure-input-1">
                            <option value="">--select one--</option>
                            <option value="1">Passive</option>
                            <option value="2">Draft</option>
                            <option value="3">Awaiting</option>
                            <option value="4">Active</option>
                        </select>

                        <input type="hidden" name="id" value="1">
                        <button type="submit" class="pure-button button-success">Save</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'ProductCreate',

        props: {
            msg: String
        },

    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>

