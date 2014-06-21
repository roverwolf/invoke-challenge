var leaderboard = leaderboard || {};

leaderboard.Player = Backbone.Model.extend({
    defaults: {
        id: null
        ,name: ''
        ,points: 0
        ,selected: false
    }

    ,addPoints: function(){
        this.set('points', this.get('points')+5);
        this.save();
    }
});

leaderboard.Players = Backbone.Collection.extend({
    model: leaderboard.Player
    ,url: '/api/players'
    ,selectedModel: null
    ,comparator: function(a, b){
        var pa = a.get('points'), pb = b.get('points'),
            na = a.get('name'), nb = b.get('name');

        return pa < pb ? 1
            : pa > pb ? -1
            : na < nb ? -1
            : na > nb ? 1
            : 0;
    }

    ,initialize: function(){
        this.on('change:selected', this.selected);
        this.on('change:points', this.sort);
    }

    ,selected: function(model){
        if (model.get('selected')) {
            this.selectedModel = model;
            _.each(this.models, function (m) {
                if (m.get('selected') && (m.id != model.id)) {
                    m.set('selected', false);
                }
            });
        }
    }
});

leaderboard.PlayerView = Backbone.View.extend({
    tag: 'div'
    ,className: 'player'
    ,template: _.template($('#template-player').html())

    ,initialize: function(){
        if (this.model) {
            this.model.on('change', this.render, this);
        }
    }

    ,events: {
        'click': 'select'
    }

    ,render: function() {
        var
            player = this.model.toJSON()
            ,html = this.template(player)
            ;

        this.$el.html(html);
        this.$el.toggleClass('selected', player.selected);

        return this;
    }

    ,select: function(){
        this.model.set('selected', true);
        this.render();
    }
});

leaderboard.DetailView = Backbone.View.extend({
    el: '.details'
    ,template: _.template($('#template-details').html())

    ,events: {
        'click input': 'givePoints'
    }

    ,render: function() {
        var
            player = this.model.toJSON()
            ,html = this.template(player)
            ;

        this.$el.html(html);

        return this;
    }

    ,givePoints: function(){
        this.model.addPoints();
    }
});

leaderboard.LeaderboardView = Backbone.View.extend({
    el: '#outer'
    ,detail: new leaderboard.DetailView()

    ,initialize: function(){
        this.listenTo(this.collection, 'all', this.render);

        this.collection.fetch();
    }

    ,render: function(){
        this.addAll();
        if (this.collection.selectedModel) {
            this.detail.model = this.collection.selectedModel;
            this.detail.render();
        }
    }

    ,addOne: function(player){
        var view = new leaderboard.PlayerView({model: player});
        this.$('.leaderboard').append(view.render().el);
    }

    ,addAll: function(){
        this.$('.leaderboard').empty();
        this.collection.each(this.addOne, this);
    }
});
