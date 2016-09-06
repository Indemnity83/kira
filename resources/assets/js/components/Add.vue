<template>

    <form class="form-inline" v-on:submit.prevent="search">
        <div class="form-group">
            <label class="sr-only" for="artist">Artist</label>
            <input type="text" v-on:keyup="search" v-model="artist" class="form-control" id="artist" placeholder="Artist">
        </div>
        <div class="form-group">
            <label class="sr-only" for="market">Market</label>
            <select v-on:change="search" v-model="market" class="form-control" id="market">
                <option value="US">US</option>
            </select>
        </div>
        <button type="submit" class="btn">Search</button>
    </form>

    <div id="results" v-show="results.length && artist">
        <h3>Search Results</h3>
        <form method="post" action="/artists">

            <div class="radio" v-for="result in results">
                <label>
                    <input type="radio" name="spotify_id" value="{{ result.id }}" v-model="picked">
                    <strong>{{ result.name }}</strong>
                    <i></i>
                </label>
            </div>
            <button type="submit" class="btn">Add Artist</button>
        </form>
    </div>

</template>

<script>
    export default {

        data: function() {
            return {
                artist: '',
                market: 'US',
                results: [],
                picked: ''
            };
        },

        methods: {
            search: function() {
              this.getSearchResults(this.artist)
            },
            getSearchResults: function() {
                if(this.artist) {
                    $.getJSON('https://api.spotify.com/v1/search?market=' + this.market + '&type=artist&q=' + this.artist, function (data) {
                        this.results = data.artists.items;
                        this.picked = this.results[0].id;
                    }.bind(this));
                }
            },
            createArtist: function() {
                $.post('/api/artists', { mbid: this.picked }, function(data) {
                    console.log(data);
                })
            }
        }

    }
</script>
