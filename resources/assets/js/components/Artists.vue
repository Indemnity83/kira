<template>
    <table class="table">
            <tr>
                <th>Artist</th>
                <th>Downloads</th>
            </tr>
            <tr v-for="artist in artists | orderBy 'name'" track-by="id">
                <td>
                    <i v-if="artist.updating" class="fa fa-spin fa-refresh" aria-hidden="true"></i>
                    <a href="/artists/{{ artist.id }}">{{ artist.name }}</a>
                </td>
                <td># / #</td>
            </tr>

        </table>
</template>

<script>
    export default {
        data() {
            return {
                artists: []
            };
        },

        ready() {
            this.listen();
            this.getArtists();
        },

        methods: {

            listen() {
                Echo.channel('artists')
                    .listen('ArtistCreated', (event) => {
                        this.artists.push(event.artist);
                    })
                    .listen('ArtistUpdated', (event) => {
                        var pos = this.artists.map(function(e) { return e.id; }).indexOf(event.artist.id);
                        this.artists.$set(pos, event.artist);
                    });
            },

            getArtists() {
                this.$http.get('/api/artists')
                    .then( response => {
                        this.artists = response.data;
                    });
            }
        }

    }
</script>
