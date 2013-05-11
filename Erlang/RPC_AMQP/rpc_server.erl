#!/usr/bin/env escript
%%! -pz ./amqp_client ./rabbit_common ./amqp_client/ebin ./rabbit_common/ebin

-include_lib("amqp_client/include/amqp_client.hrl").

main(_) ->
    {ok, Connection} = amqp_connection:start(#amqp_params_network{host = "localhost"}),
    io:format(" [*] Waiting for messages. To exit press CTRL+C~n"),

    RpcHandler = fun(X) ->
        Value = list_to_integer(binary_to_list(X)),
        io:format("[rpc_handler] ~p -> ~p", [X, Value]),
        Result = Value + 1,
        integer_to_binary(Result)
    end,
    _Server = amqp_rpc_server:start(Connection, <<"mymodule:sum">>, RpcHandler),

    receive _Msg -> ok
    end.
