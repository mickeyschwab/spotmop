import tornado.ioloop
import tornado.web
import tornado.websocket
import tornado.template
import logging

logger = logging.getLogger(__name__)

class PusherHandler(tornado.websocket.WebSocketHandler):

  connections = set()

  def check_origin(self, origin):
    return True
  
  def open(self):
    self.connections.add(self)
    logger.debug( 'New Spotmop Pusher connection' )

  def on_message(self, message):
    [connection.write_message(message) for connection in self.connections]
    logger.debug( 'Spotmop Pusher message received' )

  def on_close(self):
    self.connections.remove(self)
    logger.debug( 'Spotmop Pusher connection closed' )