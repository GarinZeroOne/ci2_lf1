/**
 * @author Gork
 */
 jQuery(document).ready(function($) {
        $(".tweet").tweet({
          join_text: "",
          username: "a3formula1",
          avatar_size:50,
          count:2,
          auto_join_text_default: ",",
          auto_join_text_ed: "yo",
          auto_join_text_ing: "estoy",
          auto_join_text_reply: "responde",
          auto_join_text_url: "vigilando",
          loading_text: "cargando tweets..."
        });
        $(".query").tweet({
          avatar_size:50,
          count:1,
          query: "tweet.seaofclouds.com",
          loading_text: "searching twitter..."
        });
      })