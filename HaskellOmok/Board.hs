module Board where
--1.
--Creation of types for both players and coordinates of the board.
 data Player = Red | Blue | None deriving (Show, Eq)
 data Coordinates = Coordinates { xC :: Int, yC :: Int, p :: Player} deriving (Show)
 -- mkBoard: Receives as input an integer n and returns an empty nxn board as the Coordinates type.
 mkBoard n = mkBoardnxn n n
 mkBoardnxn n nn = [[0|x<-[1..n]]|x<-[1..nn]]

 -- mkPlayer: Object of type 'Player', Player will be the color Red.
 mkPlayer :: Player
 mkPlayer = 1

 -- mkOpponent: Object of type 'Player', Player will be the color Blue.
 mkOpponent :: Player
 mkOpponent = 2

 -- size bd: Receives the board (array of coordinates) and returns the length of such object.
 size :: [Coordinates] -> Int 
 size bd =  length bd

 -- row y bd: Receives an integer y, where y represents a 1-based index. Returns the list of coordinates of the row.
 row y bd 
  | y<1 || y>(size bd) = []
  | otherwise = bd !! (y-1)


 -- column x bd Receives an integer x, where x represents a 1-based index. Returns the list of coordinates of the column.
 column:: Int -> [Coordinates] -> [Coordinates]
 column x bd = [a !! (x-1) | a<-bd] 

 markRow 1 (h:t) p = (m:t)
  where m = if h==0 then p else h
 markRow n (h:t) p = h : markRow (n-1) t p

 --2.
 -- mark x y bd p
 mark 1 y (h:t) p = markRow y h p : t
 mark x y (h:t) p = h:mark (x-1) y t p

 -- isEmpty x y bd
 isEmpty x y bd = ((row y bd) !! (x-1) == 0)

 -- isMarked x y bd
 --isMarked x y bd = ((row y bd) !! (x-1) /= 0)

 -- isMarkedBy x y bd p

 -- marker x y board
 marker :: Int -> Int -> [Coordinates] -> Player
 marker x y board = p (head (filter f board))
   where f i = if xC i == x && yC i == y 
                then True
                else False


 -- isFull bd
 isFull [] = True
 isFull (h:t) = isFull t && isFullRow h

 isFullRow [] = True
 isFullRow (h:t) = h/=0 && isFullRow t


--3.
 -- isWonBy bd p
 -- isDraw bd
 -- isGameOver bd
 -- boardToStr playerToChar bd
 

